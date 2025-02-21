<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'quantite', 'prix', 'categorie_id'];

    // Relation : Un produit appartient à une catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relation : Un produit peut apparaître dans plusieurs commandes
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    // Relation : Un produit peut être acheté plusieurs fois auprès de plusieurs fournisseurs
    public function achats()
    {
        return $this->belongsToMany(Achat::class, 'achat_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
