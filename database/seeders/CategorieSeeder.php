<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run()
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
