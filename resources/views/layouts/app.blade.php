<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Stock</title>

    <!-- Bootstrap & Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
        <!-- Lien vers la page principale -->
        <a class="navbar-brand" href="{{ route('home') }}">Gestion Stock</a>

        <!-- Liens du menu visibles tout le temps -->
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item mx-2">
                <a class="nav-link {{ request()->routeIs('produits.index') ? 'active' : '' }}" 
                   href="{{ route('produits.index') }}">
                    📦 Produits
                </a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link {{ request()->routeIs('mouvements.index') ? 'active' : '' }}" 
                   href="{{ route('mouvements.index') }}">
                    📜 Mouvements
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ Contenu principal -->
<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
