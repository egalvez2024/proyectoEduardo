<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *$table->string('nombre');
     * $table->integer('publicacion_id');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->word(),
        ];
    }
}
