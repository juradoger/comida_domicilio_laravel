<?php

namespace Database\Seeders;

use App\Models\rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nombre' => 'admin'],
            ['nombre' => 'empleado'],
            ['nombre' => 'cliente']
        ];

        foreach ($roles as $role) {
            Rol::factory()->create($role);
        }
    }
}
