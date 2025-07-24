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
        // Para PostgreSQL, necesitamos usar SQL raw para modificar el enum
        DB::statement("ALTER TABLE pagos DROP CONSTRAINT IF EXISTS pagos_metodo_pago_check");
        DB::statement("ALTER TABLE pagos ADD CONSTRAINT pagos_metodo_pago_check CHECK (metodo_pago IN ('efectivo', 'tarjeta', 'transferencia', 'yape'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al estado anterior
        DB::statement("ALTER TABLE pagos DROP CONSTRAINT IF EXISTS pagos_metodo_pago_check");
        DB::statement("ALTER TABLE pagos ADD CONSTRAINT pagos_metodo_pago_check CHECK (metodo_pago IN ('efectivo', 'tarjeta', 'transferencia', 'qr'))");
    }
};
