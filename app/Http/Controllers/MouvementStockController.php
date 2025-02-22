<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementStock;
use App\Models\Produit;

class MouvementStockController extends Controller
{
    public function index()
    {
        $mouvements = MouvementStock::with('produit')->orderBy('created_at', 'desc')->get();
        return view('mouvements.index', compact('mouvements'));
    }
}
