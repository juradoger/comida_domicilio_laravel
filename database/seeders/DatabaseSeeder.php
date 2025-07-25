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

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'id_rol' => 1,
        ]);

        $empleado = User::factory()->create([
            'name' => 'Empleado',
            'email' => 'empleado@example.com',
            'id_rol' => 2,
        ]);

        $cliente = User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'id_rol' => 3,
        ]);

        // Crear registro de empleado para el usuario empleado
        \App\Models\Empleado::create([
            'fecha_ingreso' => now(),
            'estado' => 'disponible',
            'dni' => '12345678',
            'licencia_conducir' => 'LIC123456',
            'calificacion_promedio' => 4.5,
            'id_usuario' => $empleado->id,
        ]);



        $this->call([
            ProductoSeeder::class,
            PedidoSeeder::class,
            DireccionSeeder::class,
        ]);
    }
}
