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
        // Para PostgreSQL necesitamos usar SQL raw para modificar el enum
        DB::statement("ALTER TABLE pedidos DROP CONSTRAINT IF EXISTS pedidos_estado_check");
        DB::statement("ALTER TABLE pedidos ADD CONSTRAINT pedidos_estado_check CHECK (estado IN ('pendiente', 'en_preparacion', 'en_camino', 'entregado', 'cancelado'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al enum original
        DB::statement("ALTER TABLE pedidos DROP CONSTRAINT IF EXISTS pedidos_estado_check");
        DB::statement("ALTER TABLE pedidos ADD CONSTRAINT pedidos_estado_check CHECK (estado IN ('pendiente', 'en_camino', 'entregado'))");
    }
};
