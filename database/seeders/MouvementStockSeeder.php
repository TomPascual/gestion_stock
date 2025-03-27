<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MouvementStock;
use App\Models\Produit;

class MouvementStockSeeder extends Seeder
{
    public function run(): void
    {
        $produits = Produit::all();

        if ($produits->count() === 0) {
            $this->command->warn("Aucun produit trouvé. Aucun mouvement créé.");
            return;
        }

        foreach ($produits as $produit) {
            // Une entrée
            MouvementStock::factory()->create([
                'produit_id' => $produit->id,
                'type' => 'entrée',
            ]);

            // Une sortie
            MouvementStock::factory()->create([
                'produit_id' => $produit->id,
                'type' => 'sortie',
            ]);
        }
    }
}
