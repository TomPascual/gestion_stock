{{-- 
    Vue : fournisseurs/edit.blade.php
    Description : Affiche le formulaire de modification d’un fournisseur existant.
    Action du formulaire :
        - PUT vers la route 'fournisseurs.update' avec l’ID du fournisseur
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le Fournisseur : {{ $fournisseur->nom }}</h1>

        <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $fournisseur->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $fournisseur->email }}">
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ $fournisseur->telephone }}">
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <textarea name="adresse" class="form-control">{{ $fournisseur->adresse }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
