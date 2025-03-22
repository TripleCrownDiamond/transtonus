<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ForceFrenchLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Forcer la locale en français
        App::setLocale('fr');

        return $next($request);
    }
}
