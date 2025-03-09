<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'email', 
        'telephone', 
        'adresse'
    ];

    /**
     * Un fournisseur peut fournir plusieurs produits
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
