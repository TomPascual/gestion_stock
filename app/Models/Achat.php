<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    protected $fillable = ['fournisseur_id', 'date_achat', 'total'];

    // Relation : Un achat appartient à un fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    // Relation : Un achat contient plusieurs produits
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'achat_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
