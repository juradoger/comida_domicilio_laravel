<?php

namespace Database\Factories;

use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacionFactory extends Factory
{
    protected $model = Notificacion::class;

    public function definition(): array
    {
        return [
            'id_usuario' => User::factory(),
            'mensaje' => $this->faker->sentence(),
            'leido' => $this->faker->boolean(),
            'fecha_envio' => $this->faker->dateTime(),
        ];
    }
}
