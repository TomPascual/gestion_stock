@extends('layouts.app')

@section('content')
<div class="container">
    <h1>📜 Historique des Mouvements</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mouvements as $mouvement)
                <tr>
                    <td>{{ $mouvement->id }}</td>
                    <td>{{ $mouvement->type }}</td>
                    <td>{{ $mouvement->produit->nom ?? 'Produit supprimé' }}</td>
                    <td>{{ $mouvement->quantite }}</td>
                    <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
