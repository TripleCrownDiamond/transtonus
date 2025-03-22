<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Stevebauman\Location\Facades\Location;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        // Force à utiliser une IP de test en développement
        $ip = $request->ip();
        $isLocalhost = in_array($ip, ['127.0.0.1', '::1']);

        if ($isLocalhost) {
            $testIp = '8.8.8.8'; // Google DNS comme IP de test
        } else {
            $testIp = $ip;
        }

        $route = $request->path();

        // Vérifier si cette IP a déjà visité cette route
        $existingVisit = Visitor::where('ip_address', $ip)
            ->where('route', $route)
            ->first();

        if (!$existingVisit) {
            // Déterminer le pays
            if ($isLocalhost) {
                $country = 'Local (Simulé: USA)';
            } else {
                try {
                    $position = Location::get($testIp);
                    $country = ($position && !empty($position->countryName)) ?
                        $position->countryName :
                        'Inconnu';
                } catch (\Exception $e) {
                    \Log::error('Erreur de géolocalisation: ' . $e->getMessage());
                    $country = 'Erreur de géolocalisation';
                }
            }

            // Enregistrer la visite avec l'IP réelle
            Visitor::create([
                'ip_address' => $ip, // Utiliser l'IP réelle, pas l'IP de test
                'country' => $country,
                'route' => $route,
            ]);
        }

        return $next($request);
    }
}
