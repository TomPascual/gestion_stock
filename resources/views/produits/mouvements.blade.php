{{-- 
    Vue : produits/mouvements.blade.php
    Description : Affiche l’historique des mouvements (entrées/sorties) pour un produit donné, 
                  et permet d’ajouter un nouveau mouvement.
    Actions :
        - POST vers la route 'produits.ajouterMouvement' pour créer un nouveau mouvement
        - Affichage d'un tableau listant les mouvements existants
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📦 Mouvements de Stock : <strong>{{ $produit->nom }}</strong></h1>

    <!-- Bouton Retour -->
    <div class="mb-3">
        <a href="{{ route('produits.index') }}" class="btn btn-outline-primary">
            🔙 Retour à la liste des produits
        </a>
    </div>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulaire pour ajouter un mouvement -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>➕ Ajouter un Mouvement</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produits.ajouterMouvement', $produit) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="type">Type de mouvement :</label>
                        <select name="type" id="type" class="form-control">
                            <option value="entrée">Entrée</option>
                            <option value="sortie">Sortie</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantite">Quantité :</label>
                        <input type="number" name="quantite" id="quantite" class="form-control" required min="1">
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="submit" class="btn btn-success w-100">➕ Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des mouvements -->
    <div class="card">
        <div class="card-header">
            <h4>📜 Historique des Mouvements</h4>
        </div>
        <div class="card-body">
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
                    @if ($mouvements->isNotEmpty()) 
                        @foreach ($mouvements as $mouvement)
                            <tr>
                                <td>{{ $mouvement->id }}</td>
                                <td>
                                    @if ($mouvement->type == 'entrée')
                                        <span class="badge bg-success">Entrée</span>
                                    @else
                                        <span class="badge bg-danger">Sortie</span>
                                    @endif
                                </td>
                                <td>{{ $mouvement->quantite }}</td>
                                <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun mouvement enregistré.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
