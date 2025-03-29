<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

/**
 * Class CategorieSeeder
 *
 * Seeder pour préremplir la base de données avec une liste de catégories standards.
 *
 * @package Database\Seeders
 */
class CategorieSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     *
     * Insère une liste de catégories prédéfinies si elles n'existent pas déjà.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            'Électronique',
            'Vêtements',
            'Alimentation',
            'Bricolage',
            'Fournitures de bureau',
            'Sport',
            'Jouets',
            'Meubles',
            'Livres',
            'Accessoires automobiles',
            'Informatique',
            'Beauté & Santé',
            'Jardinage',
            'Électroménager',
            'Instruments de musique'
        ];

        foreach ($categories as $categorie) {
            Categorie::firstOrCreate(['nom' => $categorie]);
        }
    }
}
