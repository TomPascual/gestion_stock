{{-- 
    Vue : fournisseurs/index.blade.php
    Description : Affiche la liste des fournisseurs avec actions (voir, modifier, supprimer).
    Fonctions :
        - Lien vers la création d’un nouveau fournisseur
        - Actions pour chaque fournisseur (show, edit, delete)
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Fournisseurs</h1>
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">Ajouter un fournisseur</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fournisseurs as $fournisseur)
                    <tr>
                        <td>{{ $fournisseur->nom }}</td>
                        <td>{{ $fournisseur->email }}</td>
                        <td>{{ $fournisseur->telephone }}</td>
                        <td>
                            <a href="{{ route('fournisseurs.show', $fournisseur->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce fournisseur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
