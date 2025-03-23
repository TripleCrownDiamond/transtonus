<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class SetLocale
{
    /**
     * Get available languages from the lang directory
     * 
     * @return array
     */
    private function getAvailableLanguages()
    {
        $langPath = base_path('lang');
        if (!File::exists($langPath)) {
            $langPath = resource_path('lang');
        }

        $directories = File::directories($langPath);
        return array_map('basename', $directories);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');
        $availableLanguages = $this->getAvailableLanguages();

        if (!in_array($locale, $availableLanguages)) {
            $locale = config('app.fallback_locale', 'fr'); // Default language from config or fr
        }

        App::setLocale($locale);

        // Make available languages accessible in views
        view()->share('availableLanguages', $availableLanguages);

        return $next($request);
    }
}