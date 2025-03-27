<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseurSeeder extends Seeder
{
    protected static ?string $locale = 'fr_FR';
    public function run(): void
    {
        Fournisseur::factory()->count(10)->create();
    }
}
