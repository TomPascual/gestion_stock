{{-- 
    Vue : produits/show.blade.php
    Description : Affiche les détails d’un produit spécifique, avec ses informations (quantité, prix, catégorie, fournisseur).
    Fonctions :
        - Lien vers la fiche du fournisseur si défini
        - Boutons de retour à la liste et de modification
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Produit</h1>

        <p><strong>Nom :</strong> {{ $produit->nom }}</p>
        <p><strong>Quantité :</strong> {{ $produit->quantite }}</p>
        <p><strong>Prix :</strong> {{ $produit->prix }} €</p>
        <p><strong>Catégorie :</strong> {{ $produit->categorie->nom }}</p>

        <p><strong>Fournisseur :</strong> 
            @if ($produit->fournisseur)
                <a href="{{ route('fournisseurs.show', $produit->fournisseur->id) }}">
                    {{ $produit->fournisseur->nom }}
                </a>
            @else
                Non attribué
            @endif
        </p>

        <a href="{{ route('produits.index') }}" class="btn btn-secondary">⬅ Retour</a>
        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">✏ Modifier</a>
    </div>
@endsection
