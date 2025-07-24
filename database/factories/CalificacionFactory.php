<?php

namespace Database\Factories;

use App\Models\Calificacion;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalificacionFactory extends Factory
{
    protected $model = Calificacion::class;

    public function definition(): array
    {
        return [
            'id_pedido' => Pedido::factory(),
            'id_usuario' => User::factory(),
            'id_empleado' => User::factory(),
            'calificacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->optional()->sentence(),
        ];
    }
}
