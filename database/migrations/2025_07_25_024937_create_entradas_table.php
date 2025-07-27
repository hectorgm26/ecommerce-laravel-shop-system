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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id'); // tipo de dato para la clave foranea, que hace referencia a la tabla users
            
            $table->string('titulo', 50); // los string seran varchar por defecto
            $table->string('imagen', 20)->nullable(); // nullable permite que el campo pueda ser nulo (opcional)
            $table->string('tag', 20);
            $table->text('contenido'); // text es para textos largos
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // establece una clave foranea que hace referencia a la tabla users, y si se elimina un usuario, se eliminan las entradas asociadas con Cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
