<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_empleado')->nullable()->constrained('empleados')->onDelete('cascade');
            $table->decimal('total', 8, places: 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('costo_envio', 10, 2);
            $table->dateTime('fecha_entrega');
            //metodo_pago
            $table->string('metodo_pago')->nullable();
            $table->enum('estado', ['pendiente', 'en_camino', 'entregado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
