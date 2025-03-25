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
                ])
            </div>
        </div>
    </div>
</x-app-layout>
