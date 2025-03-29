<?php

namespace App\Models;

use Database\Factories\CategorieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorie
 *
 * Représente une catégorie de produits.
 *
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Produit[] $produits
 *
 * @package App\Models
 */
class Categorie extends Model
{
    use HasFactory;

    /**
     * Crée une nouvelle instance de factory pour la catégorie.
     *
     * @return \Database\Factories\CategorieFactory
     */
    protected static function newFactory()
    {
        return CategorieFactory::new();
    }

    /**
     * Les attributs pouvant être remplis en masse.
     *
     * @var array<string>
     */
    protected $fillable = ['nom'];

    /**
     * Récupère les produits associés à cette catégorie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
