<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

/**
 * Class FournisseurController
 *
 * Gère les opérations CRUD pour les fournisseurs.
 *
 * @package App\Http\Controllers
 */
class FournisseurController extends Controller
{
    /**
     * Affiche la liste de tous les fournisseurs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau fournisseur.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Enregistre un nouveau fournisseur dans la base de données.
     *
     * @param \Illuminate\Http\Request $request Données du formulaire
     * @return \Illuminate\Http\RedirectResponse
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
     * Affiche les détails d'un fournisseur ainsi que les produits associés.
     *
     * @param \App\Models\Fournisseur $fournisseur Le fournisseur à afficher
     * @return \Illuminate\View\View
     */
    public function show(Fournisseur $fournisseur)
    {
        $produits = Produit::where('fournisseur_id', $fournisseur->id)->get();
        return view('fournisseurs.show', compact('fournisseur', 'produits'));
    }

    /**
     * Affiche le formulaire de modification d'un fournisseur existant.
     *
     * @param \App\Models\Fournisseur $fournisseur Le fournisseur à modifier
     * @return \Illuminate\View\View
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    /**
     * Met à jour les informations d'un fournisseur existant.
     *
     * @param \Illuminate\Http\Request $request Données du formulaire
     * @param \App\Models\Fournisseur $fournisseur Le fournisseur à mettre à jour
     * @return \Illuminate\Http\RedirectResponse
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
     * Supprime un fournisseur de la base de données.
     *
     * @param \App\Models\Fournisseur $fournisseur Le fournisseur à supprimer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}
