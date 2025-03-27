<?php

namespace App\Models;

use Database\Factories\CategorieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return CategorieFactory::new();
    }
    protected $fillable = ['nom'];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
