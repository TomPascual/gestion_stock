@extends('layouts.app')

@section('content')
<div class="container">
    <h1>✏️ Modifier le Produit</h1>

    <a href="{{ route('produits.index') }}" class="btn btn-primary mb-3">⬅ Retour</a>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ $produit->nom }}" required>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" id="quantite" name="quantite" class="form-control" value="{{ $produit->quantite }}" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" class="form-control" step="0.01" value="{{ $produit->prix }}" required>
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie :</label>
            <input type="text" id="categorie" name="categorie" class="form-control" value="{{ $produit->categorie->nom ?? '' }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">✅ Enregistrer</button>
    </form>
</div>
@endsection
