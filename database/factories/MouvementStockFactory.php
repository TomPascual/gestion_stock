<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;

class MouvementStockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'produit_id' => Produit::factory(),
            'type' => $this->faker->randomElement(['entree', 'sortie']),
            'quantite' => $this->faker->numberBetween(1, 100),
        ];
    }
}
