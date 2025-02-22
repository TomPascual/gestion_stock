<?php
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

Route::resource('produits', ProduitController::class);
