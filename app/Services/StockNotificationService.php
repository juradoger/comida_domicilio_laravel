<?php

namespace App\Services;

use App\Models\Notificacion;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StockNotificationService
{
    const STOCK_MINIMO = 5; // Stock mínimo antes de enviar notificación
    const STOCK_CRITICO = 0; // Stock crítico (sin stock)

    /**
     * Verificar stock de todos los productos y enviar notificaciones
     */
    public function verificarStockProductos()
    {
        $productosBajoStock = Producto::where('stock', '<=', self::STOCK_MINIMO)
            ->where('estado', 'disponible')
            ->get();

        if ($productosBajoStock->isEmpty()) {
            return;
        }

        // Obtener administradores
        $administradores = User::where('id_rol', 1)->get();

        foreach ($administradores as $admin) {
            $this->enviarNotificacionesStock($admin, $productosBajoStock);
        }
    }

    /**
     * Enviar notificaciones de stock bajo a un administrador
     */
    private function enviarNotificacionesStock(User $admin, $productosBajoStock)
    {
        $productosSinStock = $productosBajoStock->where('stock', self::STOCK_CRITICO);
        $productosBajoStock = $productosBajoStock->where('stock', '>', self::STOCK_CRITICO);

        // Notificación para productos sin stock
        if ($productosSinStock->count() > 0) {
            $this->crearNotificacion(
                $admin->id,
                'Productos sin stock',
                'stock_agotado',
                [
                    'productos' => $productosSinStock->pluck('nombre')->toArray(),
                    'cantidad' => $productosSinStock->count()
                ]
            );
        }

        // Notificación para productos con stock bajo
        if ($productosBajoStock->count() > 0) {
            $this->crearNotificacion(
                $admin->id,
                'Productos con stock bajo',
                'stock_bajo',
                [
                    'productos' => $productosBajoStock->map(function ($producto) {
                        return [
                            'nombre' => $producto->nombre,
                            'stock_actual' => $producto->stock
                        ];
                    })->toArray(),
                    'cantidad' => $productosBajoStock->count()
                ]
            );
        }

        // Notificación múltiple si hay varios productos con problemas
        if ($productosBajoStock->count() + $productosSinStock->count() > 3) {
            $this->crearNotificacion(
                $admin->id,
                'Múltiples productos requieren atención de stock',
                'stock_multiple',
                [
                    'total_productos' => $productosBajoStock->count() + $productosSinStock->count(),
                    'sin_stock' => $productosSinStock->count(),
                    'bajo_stock' => $productosBajoStock->count()
                ]
            );
        }
    }

    /**
     * Crear una notificación
     */
    private function crearNotificacion($idUsuario, $mensaje, $tipo, $datosAdicionales = [])
    {
        // Verificar si ya existe una notificación similar reciente (últimas 2 horas)
        $notificacionExistente = Notificacion::where('id_usuario', $idUsuario)
            ->where('tipo', $tipo)
            ->where('fecha_envio', '>=', now()->subHours(2))
            ->first();

        if ($notificacionExistente) {
            // Actualizar la notificación existente con nuevos datos
            $datosActuales = $notificacionExistente->datos_adicionales ?? [];
            $datosActuales = array_merge($datosActuales, $datosAdicionales);
            
            $notificacionExistente->update([
                'mensaje' => $mensaje,
                'datos_adicionales' => $datosActuales,
                'fecha_envio' => now(),
                'leido' => false
            ]);
        } else {
            // Crear nueva notificación
            Notificacion::create([
                'id_usuario' => $idUsuario,
                'mensaje' => $mensaje,
                'tipo' => $tipo,
                'datos_adicionales' => $datosAdicionales,
                'leido' => false,
                'fecha_envio' => now(),
            ]);
        }

        Log::info("Notificación de stock creada para usuario {$idUsuario}: {$mensaje}");
    }

    /**
     * Verificar stock de un producto específico (para usar después de ventas)
     */
    public function verificarStockProducto(Producto $producto)
    {
        if ($producto->stock <= self::STOCK_MINIMO) {
            $administradores = User::where('id_rol', 1)->get();
            
            foreach ($administradores as $admin) {
                $tipo = $producto->stock == 0 ? 'stock_agotado' : 'stock_bajo';
                $mensaje = $producto->stock == 0 
                    ? "El producto '{$producto->nombre}' se ha agotado"
                    : "El producto '{$producto->nombre}' tiene stock bajo ({$producto->stock} unidades)";

                $this->crearNotificacion(
                    $admin->id,
                    $mensaje,
                    $tipo,
                    [
                        'producto_id' => $producto->id,
                        'producto_nombre' => $producto->nombre,
                        'stock_actual' => $producto->stock
                    ]
                );
            }
        }
    }
} 