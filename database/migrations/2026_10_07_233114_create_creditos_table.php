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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->decimal('valor_producto', 10, 2);
            $table->decimal('cuota_inicial', 10, 2);
            $table->decimal('saldo', 10, 2);

            $table->integer('numero_cuotas');

            $table->decimal('valor_cuota', 10, 2);

            $table->date('fecha_inicio');

            $table->enum('estado', [
                'activo',
                'pagado',
                'mora'
            ])->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
