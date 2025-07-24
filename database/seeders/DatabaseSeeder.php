<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'id_rol' => 1, // Asegúrate que el rol con id=1 existe
        ]);

        $this->call([
            PedidoSeeder::class,
            DireccionSeeder::class,
        ]);
    }
}
