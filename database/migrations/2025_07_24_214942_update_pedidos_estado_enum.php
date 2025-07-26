<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modificar el ENUM directamente para MySQL
        DB::statement("ALTER TABLE pedidos MODIFY COLUMN estado ENUM('pendiente', 'aceptado', 'en_camino', 'entregado', 'cancelado') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir el ENUM al estado anterior
        DB::statement("ALTER TABLE pedidos MODIFY COLUMN estado ENUM('pendiente', 'en_camino', 'entregado') NOT NULL");
    }
};
