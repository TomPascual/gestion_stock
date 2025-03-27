<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;
use App\Models\Fournisseur;

class ProduitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'quantite' => $this->faker->numberBetween(0, 100),
            'prix' => $this->faker->randomFloat(2, 10, 200),
            'categorie_id' => Categorie::factory(),
            'fournisseur_id' => Fournisseur::factory(),
        ];
    }
}
