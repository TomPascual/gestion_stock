@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Produits</h1>
    <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un Produit</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ $produit->prix }} €</td>
                    <td>{{ $produit->categorie->nom ?? 'Aucune' }}</td>
                    <td>
                        <a href="{{ route('produits.mouvements', ['produit' => $produit->id]) }}" class="btn btn-outline-secondary btn-sm">
                            🔄 Mouvements
                        </a>
                        <a href="{{ route('produits.edit', ['produit' => $produit->id]) }}" class="btn btn-outline-warning btn-sm">
                            ✏️ Modifier
                        </a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">❌ Supprimer</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
