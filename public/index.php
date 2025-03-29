<?php

use Illuminate\Http\Request;

/**
 * Point d'entrée principal de l'application Laravel (interface web).
 *
 * Ce fichier initialise l'application, charge l'autoloader de Composer,
 * vérifie le mode maintenance, et gère la requête HTTP entrante.
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Mode maintenance
|--------------------------------------------------------------------------
|
| Si une mise en maintenance a été activée via Artisan (php artisan down),
| ce fichier s'exécutera à la place de l'application.
|
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Chargement de l'autoloader de Composer
|--------------------------------------------------------------------------
|
| Composer fournit un autoloader généré automatiquement pour notre projet,
| ce qui permet de charger dynamiquement les classes sans include manuel.
|
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Lancement de l'application Laravel
|--------------------------------------------------------------------------
|
| On instancie le noyau de l'application, on capture la requête entrante
| et on renvoie la réponse au navigateur.
|
*/
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
