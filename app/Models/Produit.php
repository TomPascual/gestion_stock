<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MouvementStock;
use Database\Factories\ProduitFactory;

/**
 * Class Produit
 *
 * Représente un produit dans le stock, associé à une catégorie, un fournisseur
 * et des mouvements de stock.
 *
 * @property int $id
 * @property string $nom
 * @property int $quantite
 * @property float $prix
 * @property int $categorie_id
 * @property int|null $fournisseur_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property \App\Models\Categorie $categorie
 * @property \App\Models\Fournisseur|null $fournisseur
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MouvementStock[] $mouvements
 *
 * @package App\Models
 */
class Produit extends Model
{
    use HasFactory;

    /**
     * Crée une nouvelle instance de factory pour le modèle Produit.
     *
     * @return \Database\Factories\ProduitFactory
     */
    protected static function newFactory()
    {
        return ProduitFactory::new();
    }

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<string>
     */
    protected $fillable = ['nom', 'quantite', 'prix', 'categorie_id', 'fournisseur_id'];

    /**
     * Récupère la catégorie associée à ce produit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Récupère les mouvements de stock liés à ce produit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class, 'produit_id');
    }

    /**
     * Récupère le fournisseur de ce produit (peut être null).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
