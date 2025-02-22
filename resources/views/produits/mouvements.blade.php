@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mouvements de stock pour {{ $produit->nom }}</h1>

    <a href="{{ route('produits.index') }}" class="btn btn-primary mb-3">Retour à la liste des produits</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulaire pour ajouter un mouvement -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Ajouter un mouvement de stock</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produits.ajouterMouvement', $produit) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="type">Type de mouvement :</label>
                    <select name="type" id="type" class="form-control">
                        <option value="entrée">Entrée</option>
                        <option value="sortie">Sortie</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" class="form-control" required min="1">
                </div>
                <button type="submit" class="btn btn-success mt-2">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Tableau des mouvements -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mouvements as $mouvement)
                <tr>
                    <td>{{ $mouvement->id }}</td>
                    <td>{{ $mouvement->type }}</td>
                    <td>{{ $mouvement->quantite }}</td>
                    <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
