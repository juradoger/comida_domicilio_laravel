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

        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'id_rol' => 1,
        ]);

        $empleado = User::firstOrCreate([
            'email' => 'empleado@example.com',
        ], [
            'name' => 'Empleado',
            'id_rol' => 2,
        ]);

        $cliente = User::firstOrCreate([
            'email' => 'cliente@example.com',
        ], [
            'name' => 'Cliente',
            'id_rol' => 3,
        ]);

        // Crear registro de empleado para el usuario empleado
        \App\Models\Empleado::firstOrCreate([
            'dni' => '12345678',
        ], [
            'fecha_ingreso' => now(),
            'estado' => 'disponible',
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
