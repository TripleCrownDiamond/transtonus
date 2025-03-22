<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login'); // Rediriger vers la page de connexion
        }

        // Vérifier si l'utilisateur a le rôle "admin"
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.'); // Retourne une erreur 403 si l'utilisateur n'est pas admin
        }

        return $next($request);
    }
}
