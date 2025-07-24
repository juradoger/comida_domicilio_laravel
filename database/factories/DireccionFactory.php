<?php

namespace Database\Factories;

use App\Models\Direccion;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class DireccionFactory extends Factory
{
    protected $model = Direccion::class;

    public function definition(): array
    {
        return [
            'id_pedido' => Pedido::factory(),
            'direccion' => $this->faker->address(),
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
        ];
    }
} 