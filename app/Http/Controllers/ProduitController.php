<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\MouvementStock;

class ProduitController extends Controller
{
    // Afficher la liste des produits
    public function index(Request $request)
    {
        // Récupération des filtres
        $search = $request->input('search');
        $categorie_id = $request->input('categorie_id');
        $fournisseur_id = $request->input('fournisseur_id');
    
        // Récupération des produits avec les filtres appliqués
        $produits = Produit::with(['categorie', 'fournisseur'])
                    ->when($search, function ($query, $search) {
                        return $query->where('nom', 'LIKE', "%{$search}%");
                    })
                    ->when($categorie_id, function ($query, $categorie_id) {
                        return $query->where('categorie_id', $categorie_id);
                    })
                    ->when($fournisseur_id, function ($query, $fournisseur_id) {
                        return $query->where('fournisseur_id', $fournisseur_id);
                    })
                    ->get();
    
        // Charger toutes les catégories et fournisseurs pour les filtres
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
    
        return view('produits.index', compact('produits', 'categories', 'fournisseurs'));
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

        $produit = Produit::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'fournisseur_id' => $request->fournisseur_id, 
        ]);
    
        MouvementStock::create([
            'produit_id' => $produit->id,
            'type' => 'entrée',
            'quantite' => $request->quantite,
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
       
        $mouvements = $produit->mouvements ?? collect(); 
    
        return view('produits.mouvements', compact('produit', 'mouvements'));
    }
    
    
    
    
    public function ajouterMouvement(Request $request, Produit $produit)
    {
        $request->validate([
            'type' => 'required|in:entrée,sortie',
            'quantite' => 'required|integer|min:1',
        ]);
    

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
