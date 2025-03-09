@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📦 Liste des Produits</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('produits.create') }}" class="btn btn-lg btn-primary">
            ➕ Ajouter un Produit
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                    <td>{{ $produit->prix }} €</td>
                    <td>{{ $produit->categorie->nom ?? 'Aucune' }}</td>
                    <td>
                            {{ $produit->fournisseur ? $produit->fournisseur->nom : 'Non attribué' }}
                        </td>
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
