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
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade'); // relación con la tabla pedidos
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // relación con la tabla productos
            $table->integer('cantidad'); // cantidad del producto en el pedido
            $table->decimal('precio', 6, 2); // precio unitario al momento del pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_detalles');
    }
};
