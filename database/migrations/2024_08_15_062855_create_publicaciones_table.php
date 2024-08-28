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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('contenido');
            $table->integer('cantidad_comentarios');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();
        });

        Schema::create('categoria_publicacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('publicacion_id');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
        Schema::dropIfExists('categoria_publicacion');
    }
};
