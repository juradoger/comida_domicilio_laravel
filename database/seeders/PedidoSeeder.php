<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        Pedido::factory(10)->create();
       
    }
}
