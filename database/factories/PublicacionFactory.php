<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->text('titulo');
     * $table->text('contenido');
     * $table->integer('cantidad_comentarios');
     * $table->unsignedBigInteger('usuario_id');
     *  $table->timestamp('fecha_creacion');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=>fake()->words(3, true),
            'contenido'=>fake()->words(10, true),
            'cantidad_comentarios' => fake()->numberBetween(),
            'usuario_id'=>fake()->numberBetween(1,50),
        ];
    }
}
