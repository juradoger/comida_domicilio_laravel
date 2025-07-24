<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalle_Pedido>
 */
class Detalle_PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pedido' => \App\Models\Pedido::factory(),
            'id_producto' => \App\Models\Producto::factory(),
            'cantidad' => fake()->numberBetween(1, 10),
            'precio_unitario' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
