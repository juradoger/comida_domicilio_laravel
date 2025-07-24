<?php

namespace Database\Seeders;

use App\Models\Calificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calificacion::factory()->count(20)->create();
    }
}
