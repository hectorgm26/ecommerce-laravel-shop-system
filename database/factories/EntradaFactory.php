<?php

namespace Database\Factories;

use App\Models\Entrada;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrada>
 */
class EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Se le indica el modelo al que pertenece esta factory
    protected $model = Entrada::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->lexify(str_repeat('?', 50)), // Genera un título aleatorio de hasta 50 caracteres
            'tag' => $this->faker->word(), 
            'imagen' => $this->faker->word(),
            'contenido' => $this->faker->paragraph(), // Genera un contenido aleatorio
            'user_id' => User::inRandomOrder()->first()->id, // Asigna un usuario aleatorio
        ];
    }
}
