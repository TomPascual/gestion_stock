<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;
use App\Models\Fournisseur;

/**
 * Class ProduitFactory
 *
 * Factory pour générer des produits factices avec des noms réalistes,
 * une quantité en stock, un prix, et des relations avec catégorie et fournisseur.
 *
 * @package Database\Factories
 */
class ProduitFactory extends Factory
{
    /**
     * Localisation du faker utilisée (français).
     *
     * @var string|null
     */
    protected static ?string $locale = 'fr_FR';

    /**
     * Définit les valeurs par défaut pour le modèle Produit.
     *
     * @return array<string, mixed>
     */
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
