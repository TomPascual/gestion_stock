<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Fournisseur;

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
        $categories = Categorie::all(); // Charger les catégories existantes
        $fournisseurs = Fournisseur::all(); // Charger les fournisseurs existants
        return view('produits.create', compact('categories', 'fournisseurs'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        ]);
    
       
    
        Produit::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'fournisseur_id' => $request->fournisseur_id, 
        ]);
    
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
        $fournisseurs = Fournisseur::all(); // Charger tous les fournisseurs
        return view('produits.edit', compact('produit', 'categories', 'fournisseurs'));
    }
    

    // Mettre à jour un produit
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
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
        // ✅ Assure que $mouvements est toujours une collection même si vide
        $mouvements = $produit->mouvements ?? collect(); 
    
        return view('produits.mouvements', compact('produit', 'mouvements'));
    }
    
    
    
    
    public function ajouterMouvement(Request $request, Produit $produit)
    {
        $request->validate([
            'type' => 'required|in:entrée,sortie',
            'quantite' => 'required|integer|min:1',
        ]);
    
        // ✅ Utilisation correcte de la relation
        $produit->mouvements()->create([
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
