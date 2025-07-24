<?php

namespace Database\Factories;

use App\Models\Reparto;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepartoFactory extends Factory
{
    protected $model = Reparto::class;

    public function definition(): array
    {
        return [
            'id_pedido' => Pedido::factory(),
            'id_repartidor' => User::factory(),
            'hora_salida' => $this->faker->optional()->dateTimeBetween('-1 days', 'now'),
            'hora_entrega' => $this->faker->optional()->dateTimeBetween('now', '+1 days'),
        ];
    }
}
