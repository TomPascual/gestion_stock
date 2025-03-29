<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use Illuminate\Http\Request;

/**
 * Class MouvementStockController
 *
 * Gère l'affichage des mouvements de stock.
 *
 * @package App\Http\Controllers
 */
class MouvementStockController extends Controller
{
    /**
     * Affiche la liste des mouvements de stock avec les produits associés.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mouvements = MouvementStock::with('produit')->latest()->get();
        return view('mouvements.index', compact('mouvements'));
    }
}
