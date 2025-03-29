<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MouvementStock;
use App\Models\Produit;

/**
 * Class MouvementStockSeeder
 *
 * Seeder pour créer des mouvements de stock (entrée et sortie)
 * pour chaque produit existant en base.
 *
 * @package Database\Seeders
 */
class MouvementStockSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     *
     * Pour chaque produit existant, crée un mouvement d'entrée et un de sortie.
     * Si aucun produit n'est présent, un message d'avertissement est affiché.
     *
     * @return void
     */
    public function run(): void
    {
        $produits = Produit::all();

        if ($produits->count() === 0) {
            $this->command->warn("Aucun produit trouvé. Aucun mouvement créé.");
            return;
        }

        foreach ($produits as $produit) {
            // Mouvement d'entrée
            MouvementStock::factory()->create([
                'produit_id' => $produit->id,
                'type' => 'entrée',
            ]);

            // Mouvement de sortie
            MouvementStock::factory()->create([
                'produit_id' => $produit->id,
                'type' => 'sortie',
            ]);
        }
    }
}
