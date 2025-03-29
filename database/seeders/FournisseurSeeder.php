<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

/**
 * Class FournisseurSeeder
 *
 * Seeder pour générer automatiquement des fournisseurs factices
 * à l’aide de la factory associée.
 *
 * @package Database\Seeders
 */
class FournisseurSeeder extends Seeder
{
    /**
     * Localisation pour les données générées (faker).
     *
     * @var string|null
     */
    protected static ?string $locale = 'fr_FR';

    /**
     * Exécute le seeder.
     *
     * Génère 10 fournisseurs avec des données aléatoires.
     *
     * @return void
     */
    public function run(): void
    {
        Fournisseur::factory()->count(10)->create();
    }
}
