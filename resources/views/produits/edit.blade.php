@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">✏️ Modifier le Produit</h1>

    <!-- Bouton Retour -->
    <a href="{{ route('produits.index') }}" class="btn btn-secondary mb-3">
        ⬅ Retour à la liste des produits
    </a>

    <div class="card">
        <div class="card-header">
            <h4>Informations du produit</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ $produit->nom }}" required>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" class="form-control" value="{{ $produit->quantite }}" required min="0">
                </div>

                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (€) :</label>
                    <input type="number" id="prix" name="prix" class="form-control" step="0.01" value="{{ $produit->prix }}" required>
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Catégorie :</label>
                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                        <option value="" disabled>Choisir une catégorie</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" 
                                {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                <label for="fournisseur_id" class="form-label">Fournisseur</label>
                <select name="fournisseur_id" class="form-control">
                    <option value="">-- Sélectionner un fournisseur --</option>
                    @foreach ($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ $produit->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
                <button type="submit" class="btn btn-success">✅ Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>
@endsection
