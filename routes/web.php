<?php

use App\Http\Controllers\ProduitController;
use App\Http\Controllers\MouvementStockController;
use Illuminate\Support\Facades\Route;

// Page d'accueil qui redirige vers Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Liste des produits
Route::resource('produits', ProduitController::class);
Route::get('produits/{produit}/mouvements', [ProduitController::class, 'mouvements'])->name('produits.mouvements');
Route::post('produits/{produit}/ajouter-mouvement', [ProduitController::class, 'ajouterMouvement'])->name('produits.ajouterMouvement');



// Historique des mouvements
Route::get('/mouvements', [MouvementStockController::class, 'index'])->name('mouvements.index');
