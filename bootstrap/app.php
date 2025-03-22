<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware globaux (optionnel, si vous en avez besoin)
        // $middleware->web([...]);

        // Middleware de route (alias)
        $middleware->alias([
            'setlocale' => \App\Http\Middleware\SetLocale::class, // Votre middleware existant
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class, // Votre nouveau middleware
            'force-french' => \App\Http\Middleware\ForceFrenchLocale::class, // Ajoutez ce middleware
            'track.visitors' => \App\Http\Middleware\TrackVisitors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configuration des exceptions (optionnel)
    })
    ->create();
