<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ConfigForm extends Component
{
    // Propriétés pour stocker les valeurs du formulaire
    public $app_name;
    public $app_address;
    public $app_city;
    public $app_country;
    public $app_phone;
    public $app_email;

    // Company information properties
    public $app_company_legal_name;
    public $app_company_registration_number;
    public $app_company_tax_id;
    public $app_company_founded;
    public $app_legal_contact_email;
    public $app_privacy_last_updated;
    public $app_terms_last_updated;
    public $app_company_jurisdiction;

    // Social media properties
    public $app_social_facebook;
    public $app_social_twitter;
    public $app_social_instagram;
    public $app_social_linkedin;

    // Désactiver le rafraîchissement automatique
    protected $updatesQueryString = [];

    // Accepter les données passées depuis la vue
    public function mount(
        $app_name = null,
        $app_address = null,
        $app_city = null,
        $app_country = null,
        $app_phone = null,
        $app_email = null,
        $app_company_legal_name = null,
        $app_company_registration_number = null,
        $app_company_tax_id = null,
        $app_company_founded = null,
        $app_legal_contact_email = null,
        $app_privacy_last_updated = null,
        $app_terms_last_updated = null,
        $app_company_jurisdiction = null,
        $app_social_facebook = null,
        $app_social_twitter = null,
        $app_social_instagram = null,
        $app_social_linkedin = null
    ) {
        $this->app_name = $app_name ?? config('app.name');
        $this->app_address = $app_address ?? env('APP_ADDRESS', '');
        $this->app_city = $app_city ?? env('APP_CITY', '');
        $this->app_country = $app_country ?? env('APP_COUNTRY', '');
        $this->app_phone = $app_phone ?? env('APP_PHONE', '');
        $this->app_email = $app_email ?? env('APP_EMAIL', '');

        // Company information
        $this->app_company_legal_name = $app_company_legal_name ?? env('APP_COMPANY_LEGAL_NAME', '');
        $this->app_company_registration_number = $app_company_registration_number ?? env('APP_COMPANY_REGISTRATION_NUMBER', '');
        $this->app_company_tax_id = $app_company_tax_id ?? env('APP_COMPANY_TAX_ID', '');
        $this->app_company_founded = $app_company_founded ?? env('APP_COMPANY_FOUNDED', '');
        $this->app_legal_contact_email = $app_legal_contact_email ?? env('APP_LEGAL_CONTACT_EMAIL', '');
        $this->app_privacy_last_updated = $app_privacy_last_updated ?? env('APP_PRIVACY_LAST_UPDATED', '');
        $this->app_terms_last_updated = $app_terms_last_updated ?? env('APP_TERMS_LAST_UPDATED', '');
        $this->app_company_jurisdiction = $app_company_jurisdiction ?? env('APP_COMPANY_JURISDICTION', '');

        // Social media
        $this->app_social_facebook = $app_social_facebook ?? env('APP_SOCIAL_FACEBOOK', '#');
        $this->app_social_twitter = $app_social_twitter ?? env('APP_SOCIAL_TWITTER', '#');
        $this->app_social_instagram = $app_social_instagram ?? env('APP_SOCIAL_INSTAGRAM', '#');
        $this->app_social_linkedin = $app_social_linkedin ?? env('APP_SOCIAL_LINKEDIN', '#');
    }

    // Règles de validation
    protected function rules()
    {
        return [
            'app_name' => 'required|string',
            'app_address' => 'required|string',
            'app_city' => 'required|string',
            'app_country' => 'required|string',
            'app_phone' => 'required|string',
            'app_email' => 'required|email',

            // Company information validation
            'app_company_legal_name' => 'required|string',
            'app_company_registration_number' => 'required|string',
            'app_company_tax_id' => 'required|string',
            'app_company_founded' => 'required|string',
            'app_legal_contact_email' => 'required|email',
            'app_privacy_last_updated' => 'required|date_format:Y-m-d',
            'app_terms_last_updated' => 'required|date_format:Y-m-d',
            'app_company_jurisdiction' => 'required|string',

            // Social media validation
            'app_social_facebook' => 'required|string',
            'app_social_twitter' => 'required|string',
            'app_social_instagram' => 'required|string',
            'app_social_linkedin' => 'required|string',
        ];
    }

    // Soumettre le formulaire - éviter redirections/refresh
    public function submit()
    {
        $this->validate();

        try {
            // Mettre à jour le fichier .env
            $envPath = base_path('.env');
            $envContent = File::get($envPath);

            $patterns = [
                '/^APP_NAME=.*$/m',
                '/^APP_ADDRESS=.*$/m',
                '/^APP_CITY=.*$/m',
                '/^APP_COUNTRY=.*$/m',
                '/^APP_PHONE=.*$/m',
                '/^APP_EMAIL=.*$/m',
                '/^APP_COMPANY_LEGAL_NAME=.*$/m',
                '/^APP_COMPANY_REGISTRATION_NUMBER=.*$/m',
                '/^APP_COMPANY_TAX_ID=.*$/m',
                '/^APP_COMPANY_FOUNDED=.*$/m',
                '/^APP_LEGAL_CONTACT_EMAIL=.*$/m',
                '/^APP_PRIVACY_LAST_UPDATED=.*$/m',
                '/^APP_TERMS_LAST_UPDATED=.*$/m',
                '/^APP_COMPANY_JURISDICTION=.*$/m',
                '/^APP_SOCIAL_FACEBOOK=.*$/m',
                '/^APP_SOCIAL_TWITTER=.*$/m',
                '/^APP_SOCIAL_INSTAGRAM=.*$/m',
                '/^APP_SOCIAL_LINKEDIN=.*$/m',
            ];

            $replacements = [
                'APP_NAME="' . $this->app_name . '"',
                'APP_ADDRESS="' . $this->app_address . '"',
                'APP_CITY="' . $this->app_city . '"',
                'APP_COUNTRY="' . $this->app_country . '"',
                'APP_PHONE="' . $this->app_phone . '"',
                'APP_EMAIL="' . $this->app_email . '"',
                'APP_COMPANY_LEGAL_NAME="' . $this->app_company_legal_name . '"',
                'APP_COMPANY_REGISTRATION_NUMBER="' . $this->app_company_registration_number . '"',
                'APP_COMPANY_TAX_ID="' . $this->app_company_tax_id . '"',
                'APP_COMPANY_FOUNDED="' . $this->app_company_founded . '"',
                'APP_LEGAL_CONTACT_EMAIL="' . $this->app_legal_contact_email . '"',
                'APP_PRIVACY_LAST_UPDATED="' . $this->app_privacy_last_updated . '"',
                'APP_TERMS_LAST_UPDATED="' . $this->app_terms_last_updated . '"',
                'APP_COMPANY_JURISDICTION="' . $this->app_company_jurisdiction . '"',
                'APP_SOCIAL_FACEBOOK="' . $this->app_social_facebook . '"',
                'APP_SOCIAL_TWITTER="' . $this->app_social_twitter . '"',
                'APP_SOCIAL_INSTAGRAM="' . $this->app_social_instagram . '"',
                'APP_SOCIAL_LINKEDIN="' . $this->app_social_linkedin . '"',
            ];

            foreach ($patterns as $index => $pattern) {
                $count = 0;
                $envContent = preg_replace($pattern, $replacements[$index], $envContent, -1, $count);

                if ($count === 0) {
                    $envContent .= PHP_EOL . $replacements[$index];
                }
            }

            File::put($envPath, $envContent);

            // Rafraîchir les valeurs en mémoire correctement
            config(['app.name' => $this->app_name]);

            // Utiliser uniquement dispatch() pour éviter le rechargement
            $this->dispatch('config-updated', ['message' => 'Configuration enregistrée avec succès.', 'type' => 'success']);

            // Empêcher tout refresh automatique
            return null;
        } catch (\Exception $e) {
            // Message d'erreur via événement
            $this->dispatch('config-update-failed', ['message' => 'Une erreur s\'est produite : ' . $e->getMessage(), 'type' => 'error']);

            // Empêcher tout refresh automatique
            return null;
        }
    }

    // Rendu du composant
    public function render()
    {
        return view('livewire.config-form');
    }
}