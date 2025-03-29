<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\MouvementStock;

/**
 * Class ProduitController
 *
 * Gère les opérations liées aux produits : création, mise à jour, suppression
 * ainsi que la gestion des mouvements de stock.
 *
 * @package App\Http\Controllers
 */
class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits avec filtres possibles (nom, catégorie, fournisseur).
     *
     * @param \Illuminate\Http\Request $request Requête HTTP contenant les filtres
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categorie_id = $request->input('categorie_id');
        $fournisseur_id = $request->input('fournisseur_id');

        $produits = Produit::with(['categorie', 'fournisseur'])
            ->when($search, fn($query) => $query->where('nom', 'LIKE', "%{$search}%"))
            ->when($categorie_id, fn($query) => $query->where('categorie_id', $categorie_id))
            ->when($fournisseur_id, fn($query) => $query->where('fournisseur_id', $fournisseur_id))
            ->get();

        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        return view('produits.index', compact('produits', 'categories', 'fournisseurs'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau produit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.create', compact('categories', 'fournisseurs'));
    }

    /**
     * Enregistre un nouveau produit en base et crée un mouvement d'entrée.
     *
     * @param \Illuminate\Http\Request $request Données du formulaire
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Affiche les détails d'un produit.
     *
     * @param \App\Models\Produit $produit Le produit à afficher
     * @return \Illuminate\View\View
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Affiche le formulaire de modification d'un produit.
     *
     * @param \App\Models\Produit $produit Le produit à modifier
     * @return \Illuminate\View\View
     */
    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.edit', compact('produit', 'categories', 'fournisseurs'));
    }

    /**
     * Met à jour les informations d'un produit.
     *
     * @param \Illuminate\Http\Request $request Données du formulaire
     * @param \App\Models\Produit $produit Le produit à mettre à jour
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Supprime un produit de la base.
     *
     * @param \App\Models\Produit $produit Le produit à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }

    /**
     * Affiche l'historique des mouvements de stock d'un produit.
     *
     * @param \App\Models\Produit $produit Le produit concerné
     * @return \Illuminate\View\View
     */
    public function mouvements(Produit $produit)
    {
        $mouvements = $produit->mouvements ?? collect();
        return view('produits.mouvements', compact('produit', 'mouvements'));
    }

    /**
     * Ajoute un mouvement de stock (entrée ou sortie) pour un produit.
     *
     * @param \Illuminate\Http\Request $request Données du formulaire
     * @param \App\Models\Produit $produit Le produit concerné
     * @return \Illuminate\Http\RedirectResponse
     */
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
