<?php

namespace Database\Factories;

use App\Models\Ue;
use App\Models\Matiere;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matiere>
 */
class MatiereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_debut' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date_fin' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
