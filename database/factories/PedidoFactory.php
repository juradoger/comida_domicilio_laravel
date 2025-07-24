<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition(): array
    {
        return [
            'id_usuario' => User::factory(),
            'id_empleado' => Empleado::factory(),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'subtotal' => $this->faker->randomFloat(2, 80, 900),
            'costo_envio' => $this->faker->randomFloat(2, 10, 100),
            'fecha_entrega' => $this->faker->dateTimeBetween('+1 days', '+10 days'),
            'estado' => $this->faker->randomElement(['pendiente', 'en_camino', 'entregado']),
        ];
    }
}
