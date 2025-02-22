<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Afficher un produit
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    // Afficher le formulaire d'édition
    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    // Mettre à jour un produit
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }
    public function mouvements(Produit $produit)
    {
        $mouvements = $produit->mouvementsStock;
        return view('produits.mouvements', compact('produit', 'mouvements'));
    }
    public function ajouterMouvement(Request $request, Produit $produit)
    {
        $request->validate([
            'type' => 'required|in:entrée,sortie',
            'quantite' => 'required|integer|min:1',
        ]);

        $produit->mouvementsStock()->create([
            'type' => $request->type,
            'quantite' => $request->quantite,
        ]);

        if ($request->type == 'entrée') {
            $produit->increment('quantite', $request->quantite);
        } else {
            $produit->decrement('quantite', $request->quantite);
        }

        return redirect()->route('produits.mouvements', $produit)->with('success', 'Mouvement ajouté avec succès.');
    }

}
