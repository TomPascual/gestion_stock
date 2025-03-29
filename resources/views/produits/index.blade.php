{{-- 
    Vue : produits/index.blade.php
    Description : Affiche la liste des produits avec options de recherche et filtres (catégorie, fournisseur).
    Fonctions disponibles :
        - Filtres dynamiques par nom, catégorie, fournisseur
        - Bouton d’ajout de produit
        - Accès aux mouvements du produit
        - Actions CRUD (modifier, supprimer)
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📦 Liste des Produits</h1>

    <!-- Formulaire de recherche et filtres -->
    <form method="GET" action="{{ route('produits.index') }}" class="mb-4">
        <div class="row g-2">
            <!-- 🔎 Recherche par nom -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..."
                       value="{{ request('search') }}">
            </div>

            <!-- Filtre par Catégorie -->
            <div class="col-md-3">
                <select name="categorie_id" class="form-select">
                    <option value="">Toutes les catégories</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ request('categorie_id') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre par Fournisseur -->
            <div class="col-md-3">
                <select name="fournisseur_id" class="form-select">
                    <option value="">Tous les fournisseurs</option>
                    @foreach ($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ request('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton de recherche -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">🔎 Rechercher</button>
            </div>
        </div>
    </form>

    <!-- Bouton d'ajout -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('produits.create') }}" class="btn btn-lg btn-primary">
            ➕ Ajouter un Produit
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tableau des produits -->
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Fournisseur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                    <td>{{ $produit->id }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                    <td>{{ $produit->categorie->nom ?? 'Aucune' }}</td>
                    <td>{{ $produit->fournisseur->nom ?? 'Non attribué' }}</td>
                    <td class="d-flex gap-2">
                        <!-- Mouvements -->
                        <a href="{{ route('produits.mouvements', ['produit' => $produit->id]) }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left-right"></i> Mouvements
                        </a>

                        <!-- Modifier -->
                        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                        <!-- Supprimer -->
                        <form action="{{ route('produits.destroy', $produit) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
