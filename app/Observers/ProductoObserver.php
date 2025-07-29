<?php

namespace App\Observers;

use App\Models\Producto;
use App\Models\Notificacion;
use App\Models\User;

class ProductoObserver
{
    const STOCK_MINIMO = 5; // Stock mínimo antes de enviar notificación
    const STOCK_CRITICO = 0; // Stock crítico (sin stock)

    /**
     * Handle the Producto "updated" event.
     */
    public function updated(Producto $producto): void
    {
        // Verificar si el stock cambió
        if ($producto->wasChanged('stock')) {
            $this->verificarStockYNotificar($producto);
        }
    }

    /**
     * Verificar stock y enviar notificaciones si es necesario
     */
    private function verificarStockYNotificar(Producto $producto)
    {
        // Solo verificar si el producto está disponible
        if ($producto->estado !== 'disponible') {
            return;
        }

        // Obtener todos los administradores
        $administradores = User::where('id_rol', 1)->get();

        foreach ($administradores as $admin) {
            $this->enviarNotificacionStock($admin, $producto);
        }
    }

    /**
     * Enviar notificación de stock a un administrador
     */
    private function enviarNotificacionStock(User $admin, Producto $producto)
    {
        $tipo = null;
        $mensaje = '';
        $datosAdicionales = [
            'producto_id' => $producto->id,
            'producto_nombre' => $producto->nombre,
            'stock_actual' => $producto->stock
        ];

        // Determinar tipo de notificación
        if ($producto->stock == self::STOCK_CRITICO) {
            $tipo = 'stock_agotado';
            $mensaje = "El producto '{$producto->nombre}' se ha agotado";
        } elseif ($producto->stock <= self::STOCK_MINIMO) {
            $tipo = 'stock_bajo';
            $mensaje = "El producto '{$producto->nombre}' tiene stock bajo ({$producto->stock} unidades)";
        } else {
            // Si el stock está bien, no enviar notificación
            return;
        }

        // Verificar si ya existe una notificación similar reciente (últimas 2 horas)
        $notificacionExistente = Notificacion::where('id_usuario', $admin->id)
            ->where('tipo', $tipo)
            ->where('datos_adicionales->producto_id', $producto->id)
            ->where('fecha_envio', '>=', now()->subHours(2))
            ->first();

        if ($notificacionExistente) {
            // Actualizar la notificación existente
            $notificacionExistente->update([
                'mensaje' => $mensaje,
                'datos_adicionales' => $datosAdicionales,
                'fecha_envio' => now(),
                'leido' => false
            ]);
        } else {
            // Crear nueva notificación
            Notificacion::create([
                'id_usuario' => $admin->id,
                'mensaje' => $mensaje,
                'tipo' => $tipo,
                'datos_adicionales' => $datosAdicionales,
                'leido' => false,
                'fecha_envio' => now(),
            ]);
        }
    }
} 