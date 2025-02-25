<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestionnaire de Stock</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Bootstrap -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-center flex flex-col justify-center items-center min-h-screen">

    <div class="container">
        <h1 class="text-4xl font-bold my-6 text-gray-800">Gestionnaire de Stock</h1>

        <div class="d-flex justify-content-center gap-4">
                    <a href="{{ route('produits.index') }}" class="btn btn-primary btn-lg shadow">
                📦 Liste des Produits
            </a>

            <a href="{{ route('mouvements.index') }}" class="btn btn-secondary btn-lg shadow">
                📜 Historique des Mouvements
            </a>
        </div>
    </div>


</body>
</html>
