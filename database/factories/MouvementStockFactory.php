<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class MouvementStockFactory
 *
 * Factory pour générer des mouvements de stock factices (entrée ou sortie).
 * Idéale pour les tests ou le seeding de l'historique de stock.
 *
 * @package Database\Factories
 */
class MouvementStockFactory extends Factory
{
    /**
     * Définit les valeurs par défaut pour le modèle MouvementStock.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['entrée', 'sortie']),
            'quantite' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
