{{-- 
    Vue : layouts/app.blade.php
    Description : Layout principal de l’application. 
    Il contient l’en-tête (navbar), l’importation de Bootstrap et Tailwind, 
    et le `@yield('content')` pour injecter les contenus spécifiques à chaque page.
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Stock</title>

    <!-- Bootstrap & Tailwind pour le style -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Barre de navigation principale -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container d-flex justify-content-between">
            <!-- Lien vers la page d'accueil -->
            <a class="navbar-brand" href="{{ route('home') }}">Gestion Stock</a>

            <!-- Liens de navigation -->
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
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('fournisseurs.index') ? 'active' : '' }}" 
                       href="{{ route('fournisseurs.index') }}">
                        🚚 Fournisseurs
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Section de contenu injectée depuis les vues enfants -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>
