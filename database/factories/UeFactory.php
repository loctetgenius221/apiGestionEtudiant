<?php

namespace Database\Factories;

use App\Models\Ue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ue>
 */
class UeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->unique()->randomElement([
                'Mathématiques', 'Informatique', 'Physique', 'Chimie',
                'Biologie', 'Langues', 'Sciences Humaines', 'Économie'
            ]),
            'date_debut' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date_fin' => $this->faker->dateTimeBetween('now', '+1 year'),
            'coef' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
