<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\Empleado;
use App\Models\Notificacion;

class PedidoObserver
{
    /**
     * Handle the Pedido "created" event.
     */
    public function created(Pedido $pedido): void
    {
        //
    }

    /**
     * Handle the Pedido "updated" event.
     */
    public function updated(Pedido $pedido): void
    {
        // Obtener los cambios realizados
        $changes = $pedido->getChanges();
        $original = $pedido->getOriginal();

        // Si se asignó un empleado por primera vez o se cambió
        if (array_key_exists('id_empleado', $changes) && $pedido->id_empleado) {
            $empleadoAnterior = $original['id_empleado'] ?? null;

            if ($empleadoAnterior != $pedido->id_empleado) {
                $empleado = Empleado::with('usuario')->find($pedido->id_empleado);

                if ($empleado && $empleado->usuario) {
                    // Notificación para el empleado
                    Notificacion::create([
                        'id_usuario' => $empleado->usuario->id,
                        'mensaje' => '🚴‍♂️ ¡Te hemos asignado un nuevo pedido! Pedido #' . $pedido->id . ' por un total de Bs ' . number_format($pedido->total, 2) . '. Revisa los detalles y prepárate para la entrega.',
                        'leido' => false,
                        'fecha_envio' => now(),
                    ]);
                }
            }
        }

        // Si cambió el estado
        if (array_key_exists('estado', $changes)) {
            $estadoAnterior = $original['estado'] ?? null;
            $estadoNuevo = $pedido->estado;

            // Si cambia a "en_camino"
            if ($estadoAnterior != 'en_camino' && $estadoNuevo == 'en_camino') {
                $empleado = Empleado::with('usuario')->find($pedido->id_empleado);
                $nombreRepartidor = $empleado && $empleado->usuario ? $empleado->usuario->name : 'nuestro repartidor';

                // Notificación para el cliente
                Notificacion::create([
                    'id_usuario' => $pedido->id_usuario,
                    'mensaje' => '🛵 ¡Tu pedido está en camino! ' . $nombreRepartidor . ' está llevando tu pedido #' . $pedido->id . '. Estará contigo muy pronto. ¡Prepara tu apetito!',
                    'leido' => false,
                    'fecha_envio' => now(),
                ]);
            }

            // Si cambia a "entregado"
            if ($estadoAnterior != 'entregado' && $estadoNuevo == 'entregado') {
                // Notificación para el cliente
                Notificacion::create([
                    'id_usuario' => $pedido->id_usuario,
                    'mensaje' => '✅ ¡Tu pedido #' . $pedido->id . ' ha sido entregado exitosamente! Esperamos que disfrutes tu comida. ¡Gracias por confiar en nosotros!',
                    'leido' => false,
                    'fecha_envio' => now(),
                ]);
            }
        }
    }

    /**
     * Handle the Pedido "deleted" event.
     */
    public function deleted(Pedido $pedido): void
    {
        //
    }

    /**
     * Handle the Pedido "restored" event.
     */
    public function restored(Pedido $pedido): void
    {
        //
    }

    /**
     * Handle the Pedido "force deleted" event.
     */
    public function forceDeleted(Pedido $pedido): void
    {
        //
    }
}
