{{-- 
    Vue : produits/create.blade.php
    Description : Formulaire de création d’un nouveau produit.
    Action du formulaire :
        - POST vers la route 'produits.store'
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🆕 Ajouter un Produit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Bouton Retour -->
    <a href="{{ route('produits.index') }}" class="btn btn-secondary mb-3">
        ⬅ Retour à la liste des produits
    </a>

    <div class="card">
        <div class="card-header">
            <h4>Informations du produit</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('produits.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" class="form-control" required min="1">
                </div>

                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (€)</label>
                    <input type="number" step="0.01" name="prix" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Catégorie</label>
                    <select name="categorie_id" class="form-control" required>
                        <option value="" disabled selected>Choisir une catégorie</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fournisseur_id" class="form-label">Fournisseur</label>
                    <select name="fournisseur_id" class="form-control">
                        <option value="">-- Sélectionner un fournisseur --</option>
                        @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">✅ Ajouter le produit</button>
            </form>
        </div>
    </div>
</div>
@endsection
