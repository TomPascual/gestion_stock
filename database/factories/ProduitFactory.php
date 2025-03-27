<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;
use App\Models\Fournisseur;

class ProduitFactory extends Factory
{
    protected static ?string $locale = 'fr_FR';

    public function definition(): array
    {
        $noms = [
            'Ordinateur portable', 'Clavier sans fil', 'T-shirt coton', 'Chaussures de sport',
            'Bouteille d\'eau', 'Stylo bleu', 'Crème hydratante', 'Cahier A4',
            'Lampe de bureau', 'Table basse', 'Sac à dos', 'Souris optique',
            'Café moulu', 'Chargeur USB-C', 'Perceuse électrique', 'Gants de jardin',
            'Livret de recettes', 'Casque audio', 'Jeu de société', 'Webcam HD'
        ];

        return [
            'nom' => $this->faker->randomElement($noms),
            'quantite' => $this->faker->numberBetween(1, 100),
            'prix' => $this->faker->randomFloat(2, 5, 300),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'fournisseur_id' => Fournisseur::inRandomOrder()->first()?->id ?? Fournisseur::factory(),
        ];
    }
}
