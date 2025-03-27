<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MouvementStock;
use Database\Factories\ProduitFactory;

class Produit extends Model
{
    use HasFactory;

     protected static function newFactory()
    {
        return ProduitFactory::new();
    }
    protected $fillable = ['nom', 'quantite', 'prix', 'categorie_id', 'fournisseur_id'];
    

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

   
    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class, 'produit_id');
    }
    
    public function fournisseur()
{
    return $this->belongsTo(Fournisseur::class);
}

    

}
