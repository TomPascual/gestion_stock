{{-- 
    Vue : fournisseurs/show.blade.php
    Description : Affiche les informations détaillées d’un fournisseur ainsi que la liste de ses produits associés.
    Actions :
        - Retour à la liste des fournisseurs
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Fournisseur : {{ $fournisseur->nom }}</h1>
        <p>Email : {{ $fournisseur->email }}</p>
        <p>Téléphone : {{ $fournisseur->telephone }}</p>
        <p>Adresse : {{ $fournisseur->adresse }}</p>

        <h2>Produits Fournis</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->description }}</td>
                        <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                        <td>{{ $produit->quantite }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @if ($produits->isEmpty())
            <p class="text-muted">Ce fournisseur n'a aucun produit associé.</p>
        @endif
        
        <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
