<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class FournisseurFactory
 *
 * Factory pour générer des fournisseurs factices.
 * Utilisée pour les tests et le remplissage de la base de données.
 *
 * @package Database\Factories
 */
class FournisseurFactory extends Factory
{
    /**
     * Définit les valeurs par défaut pour le modèle Fournisseur.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
        ];
    }
}
