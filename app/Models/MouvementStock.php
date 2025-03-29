<?php

namespace App\Models;

use Database\Factories\MouvementStockFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MouvementStock
 *
 * Représente un mouvement de stock (entrée ou sortie) associé à un produit.
 *
 * @property int $id
 * @property int $produit_id
 * @property string $type Type de mouvement : 'entrée' ou 'sortie'
 * @property int $quantite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property \App\Models\Produit $produit
 *
 * @package App\Models
 */
class MouvementStock extends Model
{
    use HasFactory;

    /**
     * Crée une nouvelle instance de factory pour les mouvements de stock.
     *
     * @return \Database\Factories\MouvementStockFactory
     */
    protected static function newFactory()
    {
        return MouvementStockFactory::new();
    }

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'mouvements_stock';

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<string>
     */
    protected $fillable = ['produit_id', 'type', 'quantite'];

    /**
     * Récupère le produit lié à ce mouvement de stock.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
