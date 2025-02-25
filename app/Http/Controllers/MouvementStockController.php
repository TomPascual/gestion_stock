<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use Illuminate\Http\Request;

class MouvementStockController extends Controller
{
    public function index()
    {
        $mouvements = MouvementStock::with('produit')->latest()->get();
        return view('mouvements.index', compact('mouvements'));
    }
}
