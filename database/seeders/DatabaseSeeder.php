<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * Seeder principal appelé lors d’un `php artisan db:seed`.
 * Il orchestre l’exécution des seeders individuels pour peupler la base.
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Exécute l'ensemble des seeders enregistrés.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CategorieSeeder::class,
            FournisseurSeeder::class,
            ProduitSeeder::class,
            MouvementStockSeeder::class,
        ]);
    }
}
