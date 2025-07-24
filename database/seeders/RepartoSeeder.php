<?php

namespace Database\Seeders;

use App\Models\Reparto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepartoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reparto::factory()->count(20)->create();
    }
}
