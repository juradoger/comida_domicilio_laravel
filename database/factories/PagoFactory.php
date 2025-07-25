<?php

namespace Database\Factories;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    protected $model = Pago::class;

    public function definition(): array
    {
        return [
            'id_pedido' => Pedido::factory(),
            'metodo_pago' => $this->faker->randomElement(['efectivo', 'tarjeta', 'transferencia', 'yape']),
            'monto' => $this->faker->randomFloat(2, 10, 1000),
            'estado_pago' => $this->faker->randomElement(['pendiente', 'pagado', 'fallido']),
        ];
    }
}
