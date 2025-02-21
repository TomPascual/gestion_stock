<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandeProduit extends Pivot
{
    use HasFactory;

    protected $table = 'commande_produits';

    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prix_unitaire'];
}
