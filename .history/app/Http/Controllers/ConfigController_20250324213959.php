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
            // Company information
            'APP_COMPANY_LEGAL_NAME' => env('APP_COMPANY_LEGAL_NAME'),
            'APP_COMPANY_REGISTRATION_NUMBER' => env('APP_COMPANY_REGISTRATION_NUMBER'),
            'APP_COMPANY_TAX_ID' => env('APP_COMPANY_TAX_ID'),
            'APP_COMPANY_FOUNDED' => env('APP_COMPANY_FOUNDED'),
            'APP_LEGAL_CONTACT_EMAIL' => env('APP_LEGAL_CONTACT_EMAIL'),
            'APP_PRIVACY_LAST_UPDATED' => env('APP_PRIVACY_LAST_UPDATED'),
            'APP_TERMS_LAST_UPDATED' => env('APP_TERMS_LAST_UPDATED'),
            'APP_COMPANY_JURISDICTION' => env('APP_COMPANY_JURISDICTION'),
            // Social media links
            'APP_SOCIAL_FACEBOOK' => env('APP_SOCIAL_FACEBOOK'),
            'APP_SOCIAL_TWITTER' => env('APP_SOCIAL_TWITTER'),
            'APP_SOCIAL_INSTAGRAM' => env('APP_SOCIAL_INSTAGRAM'),
            'APP_SOCIAL_LINKEDIN' => env('APP_SOCIAL_LINKEDIN'),
        ];

        // Passer les données à la vue
        return view('configs', compact('config'));
    }
}