<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition(): array
    {
        return [
            'fecha_ingreso' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['disponible', 'ocupado']),
            'dni' => $this->faker->unique()->numerify('########'),
            'licencia_conducir' => $this->faker->optional()->bothify('LIC####'),
            'calificacion_promedio' => $this->faker->randomFloat(2, 1, 5),
            'id_usuario' => User::factory(),
        ];
    }
}
