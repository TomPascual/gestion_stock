<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class CategorieFactory
 *
 * Factory pour générer des instances de la classe Categorie.
 * Utilisée pour les tests et le remplissage de la base avec des données factices.
 *
 * @package Database\Factories
 */
class CategorieFactory extends Factory
{
    /**
     * Définit les valeurs par défaut pour le modèle Categorie.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->words(2, true),
        ];
    }
}
