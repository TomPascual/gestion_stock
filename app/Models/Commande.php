<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date_commande', 'total', 'status'];

    // Relation : Une commande appartient à un utilisateur (client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une commande contient plusieurs produits
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
