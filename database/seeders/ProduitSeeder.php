<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;

class ProduitSeeder extends Seeder
{
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
