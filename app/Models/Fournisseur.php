<?php

namespace App\Models;

use Database\Factories\FournisseurFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return FournisseurFactory::new();
    }
    protected $fillable = [
        'nom', 
        'email', 
        'telephone', 
        'adresse'
    ];


    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    
}
