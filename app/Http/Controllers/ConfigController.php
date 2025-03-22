<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    // Afficher le formulaire de configuration
    public function index()
    {
        // Récupérer les données actuelles du fichier .env
        $config = [
            'APP_NAME' => env('APP_NAME'),
            'APP_ADDRESS' => env('APP_ADDRESS'),
            'APP_CITY' => env('APP_CITY'),
            'APP_COUNTRY' => env('APP_COUNTRY'),
            'APP_PHONE' => env('APP_PHONE'),
            'APP_EMAIL' => env('APP_EMAIL'),
        ];

        // Passer les données à la vue
        return view('configs', compact('config'));
    }
}
