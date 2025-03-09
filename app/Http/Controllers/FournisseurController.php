<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Afficher la liste des fournisseurs.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Afficher le formulaire de création d'un fournisseur.
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Enregistrer un nouveau fournisseur en base.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:fournisseurs,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ]);

        Fournisseur::create($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un fournisseur et ses produits.
     */
    public function show(Fournisseur $fournisseur)
    {
        $produits = Produit::where('fournisseur_id', $fournisseur->id)->get();
        return view('fournisseurs.show', compact('fournisseur', 'produits'));
    }

    /**
     * Afficher le formulaire de modification d'un fournisseur.
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    /**
     * Mettre à jour un fournisseur en base.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:fournisseurs,email,'.$fournisseur->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ]);

        $fournisseur->update($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès.');
    }

    /**
     * Supprimer un fournisseur.
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}
