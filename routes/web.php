<?php

use App\Http\Controllers\ProduitController;
use App\Http\Controllers\MouvementStockController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ce fichier contient les routes accessibles via le navigateur (interface web).
| Les routes sont organisées par fonctionnalité (produits, fournisseurs, mouvements).
|
*/

/**
 * Page d'accueil
 * Route: /
 * Vue : resources/views/home.blade.php
 */
Route::get('/', function () {
    return view('home');
})->name('home');

/**
 * Ressources Produits
 * CRUD complet + mouvements de stock
 */
Route::resource('produits', ProduitController::class);

/**
 * Liste des mouvements de stock d’un produit
 * Route: GET /produits/{produit}/mouvements
 */
Route::get('produits/{produit}/mouvements', [ProduitController::class, 'mouvements'])
    ->name('produits.mouvements');

/**
 * Ajouter un mouvement de stock pour un produit
 * Route: POST /produits/{produit}/ajouter-mouvement
 */
Route::post('produits/{produit}/ajouter-mouvement', [ProduitController::class, 'ajouterMouvement'])
    ->name('produits.ajouterMouvement');

/**
 * Ressources Fournisseurs
 * CRUD complet
 */
Route::resource('fournisseurs', FournisseurController::class);

/**
 * Liste générale des mouvements de stock (tous produits confondus)
 * Route: GET /mouvements
 */
Route::get('/mouvements', [MouvementStockController::class, 'index'])
    ->name('mouvements.index');
