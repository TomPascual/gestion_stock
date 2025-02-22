<?php
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

// Redirection de la page d'accueil vers la liste des produits
Route::get('/', function () {
    return redirect()->route('produits.index');
});

// Ressources pour les produits
Route::resource('produits', ProduitController::class);
Route::get('produits/{produit}/mouvements', [ProduitController::class, 'mouvements'])->name('produits.mouvements');
Route::post('produits/{produit}/mouvements', [ProduitController::class, 'ajouterMouvement'])->name('produits.ajouterMouvement');
