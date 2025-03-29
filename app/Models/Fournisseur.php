<?php

namespace App\Models;

use Database\Factories\FournisseurFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fournisseur
 *
 * Représente un fournisseur de produits.
 *
 * @property int $id
 * @property string $nom
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $adresse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Produit[] $produits
 *
 * @package App\Models
 */
class Fournisseur extends Model
{
    use HasFactory;

    /**
     * Crée une nouvelle instance de factory pour le fournisseur.
     *
     * @return \Database\Factories\FournisseurFactory
     */
    protected static function newFactory()
    {
        return FournisseurFactory::new();
    }

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nom', 
        'email', 
        'telephone', 
        'adresse'
    ];

    /**
     * Récupère les produits associés à ce fournisseur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
