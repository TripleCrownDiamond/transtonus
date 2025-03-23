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

    // Désactiver le rafraîchissement automatique
    protected $updatesQueryString = [];

    // Accepter les données passées depuis la vue
    public function mount($app_name = null, $app_address = null, $app_city = null, $app_country = null, $app_phone = null, $app_email = null)
    {
        $this->app_name = $app_name ?? config('app.name');
        $this->app_address = $app_address ?? env('APP_ADDRESS', '');
        $this->app_city = $app_city ?? env('APP_CITY', '');
        $this->app_country = $app_country ?? env('APP_COUNTRY', '');
        $this->app_phone = $app_phone ?? env('APP_PHONE', '');
        $this->app_email = $app_email ?? env('APP_EMAIL', '');
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
            ];

            $replacements = [
                'APP_NAME="' . $this->app_name . '"',
                'APP_ADDRESS="' . $this->app_address . '"',
                'APP_CITY="' . $this->app_city . '"',
                'APP_COUNTRY="' . $this->app_country . '"',
                'APP_PHONE="' . $this->app_phone . '"',
                'APP_EMAIL="' . $this->app_email . '"',
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