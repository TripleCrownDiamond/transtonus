<!-- resources/views/configs.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configuration de l'application
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Passer les données du fichier .env au composant Livewire -->
                @livewire('config-form', [
                    'app_name' => env('APP_NAME', ''),
                    'app_address' => env('APP_ADDRESS', ''),
                    'app_city' => env('APP_CITY', ''),
                    'app_country' => env('APP_COUNTRY', ''),
                    'app_phone' => env('APP_PHONE', ''),
                    'app_email' => env('APP_EMAIL', ''),
                    // Company information
                    'app_company_legal_name' => env('APP_COMPANY_LEGAL_NAME', ''),
                    'app_company_registration_number' => env('APP_COMPANY_REGISTRATION_NUMBER', ''),
                    'app_company_tax_id' => env('APP_COMPANY_TAX_ID', ''),
                    'app_company_founded' => env('APP_COMPANY_FOUNDED', ''),
                    'app_legal_contact_email' => env('APP_LEGAL_CONTACT_EMAIL', ''),
                    'app_privacy_last_updated' => env('APP_PRIVACY_LAST_UPDATED', ''),
                    'app_terms_last_updated' => env('APP_TERMS_LAST_UPDATED', ''),
                    'app_company_jurisdiction' => env('APP_COMPANY_JURISDICTION', ''),
                    // Social media links
                    'app_social_facebook' => env('APP_SOCIAL_FACEBOOK', '#'),
                    'app_social_twitter' => env('APP_SOCIAL_TWITTER', '#'),
                    'app_social_instagram' => env('APP_SOCIAL_INSTAGRAM', '#'),
                    'app_social_linkedin' => env('APP_SOCIAL_LINKEDIN', '#'),
                ])
            </div>
        </div>
    </div>
</x-app-layout>
