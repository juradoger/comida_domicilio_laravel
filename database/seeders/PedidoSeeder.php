<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Detalle_pedido;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Producto;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener usuarios con rol de cliente (id_rol = 3) y empleados existentes
        $clientes = User::where('id_rol', 3)->get();
        $empleados = Empleado::all();
        $productos = Producto::all();

        // Si no hay empleados o productos, crearlos
        if ($empleados->isEmpty()) {
            $empleados = Empleado::factory(5)->create();
        }

        if ($productos->isEmpty()) {
            $productos = Producto::factory(20)->create();
        }

        // Si no hay clientes, crear algunos
        if ($clientes->isEmpty()) {
            $clientes = User::factory(5)->create(['id_rol' => 3]);
        }

        // Crear 10 pedidos
        for ($i = 0; $i < 10; $i++) {
            $pedido = Pedido::create([
                'id_usuario' => $clientes->random()->id,
                'id_empleado' => $empleados->random()->id,
                'total' => 0, // Lo calcularemos después
                'subtotal' => 0, // Lo calcularemos después
                'costo_envio' => fake()->randomFloat(2, 5, 15),
                'fecha_entrega' => fake()->dateTimeBetween('+1 days', '+7 days'),
                'estado' => fake()->randomElement(['pendiente', 'en_preparacion', 'en_camino', 'entregado', 'cancelado']),
            ]);

            // Crear entre 2 y 6 detalles de pedido para cada pedido
            $numeroDetalles = fake()->numberBetween(2, 6);
            $subtotal = 0;

            for ($j = 0; $j < $numeroDetalles; $j++) {
                $producto = $productos->random();
                $cantidad = fake()->numberBetween(1, 5);
                $precioUnitario = fake()->randomFloat(2, 8, 50);

                Detalle_pedido::create([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                ]);

                $subtotal += ($cantidad * $precioUnitario);
            }

            // Actualizar el pedido con los totales calculados
            $pedido->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $pedido->costo_envio,
            ]);
        }
    }
}
