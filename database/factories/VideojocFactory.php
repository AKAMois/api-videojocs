<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Una Factory genera datos falsos pero realistas para pruebas o para poblar la BD.
// Se usa junto con el Seeder: Videojoc::factory()->count(20)->create()
// Internamente usa la librería Faker para generar datos aleatorios.
class VideojocFactory extends Factory
{
    // definition() define qué valor tiene cada campo cuando se genera un registro
    public function definition(): array
    {
        return [
            // fake()->words(3, true) genera 3 palabras aleatorias como string (ej: "shadow dark quest")
            'titol'          => fake()->words(3, true),

            // randomElement() escoge un valor al azar de la lista
            'genere'         => fake()->randomElement(['RPG', 'FPS', 'Aventura', 'Esports', 'Plataformes']),
            'plataforma'     => fake()->randomElement(['PC', 'PS5', 'Xbox', 'Switch']),

            // numberBetween() genera un entero entre los dos valores dados
            'any_llancament' => fake()->numberBetween(2000, 2024),

            // randomFloat(2, 9.99, 79.99) genera un decimal con 2 decimales entre 9.99 y 79.99
            'preu'           => fake()->randomFloat(2, 9.99, 79.99),
        ];
    }
}
