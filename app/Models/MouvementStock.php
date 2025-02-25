<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{
    use HasFactory;

    protected $table = 'mouvements_stock'; // Assure-toi que le nom correspond bien à la migration
    protected $fillable = ['produit_id', 'type', 'quantite'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
