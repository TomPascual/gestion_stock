<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;

/**
 * Class ProduitSeeder
 *
 * Seeder pour générer des produits avec une association aléatoire
 * à des catégories et des fournisseurs existants.
 *
 * @package Database\Seeders
 */
class ProduitSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     *
     * Vérifie qu'il existe au moins une catégorie et un fournisseur,
     * puis génère 20 produits aléatoires, chacun lié à une catégorie et un fournisseur.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        if ($categories->count() === 0 || $fournisseurs->count() === 0) {
            $this->command->warn("Aucune catégorie ou fournisseur trouvé. Les produits ne seront pas créés.");
            return;
        }

        Produit::factory()->count(20)->make()->each(function ($produit) use ($categories, $fournisseurs) {
            $produit->categorie_id = $categories->random()->id;
            $produit->fournisseur_id = $fournisseurs->random()->id;
            $produit->save();
        });
    }
}
