@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historique des Entrées et Sorties</h1>
    <a href="{{ route('produits.index') }}" class="btn btn-primary mb-3">Retour à la liste des produits</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mouvements as $mouvement)
                <tr>
                    <td>{{ $mouvement->id }}</td>
                    <td>{{ $mouvement->produit->nom ?? 'Produit supprimé' }}</td>
                    <td class="{{ $mouvement->type == 'entrée' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($mouvement->type) }}
                    </td>
                    <td>{{ $mouvement->quantite }}</td>
                    <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
