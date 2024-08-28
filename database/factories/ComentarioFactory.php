<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('usuario');
     *$table->unsignedBigInteger('publicaiones_id');
     * $table->string('texto_comentario');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario' => fake()->name(),
            'publicaciones_id' => fake()-> numberBetween(1,100),
            'texto_comentario' => fake()->words(10, true)
        ];
    }
}
