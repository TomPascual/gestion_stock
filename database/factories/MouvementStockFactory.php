<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MouvementStockFactory extends Factory
{
    public function definition(): array
    {
        return [
          
            'type' => $this->faker->randomElement(['entrée', 'sortie']),
            'quantite' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
