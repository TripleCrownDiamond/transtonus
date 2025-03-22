<!-- resources/views/components/config-form.blade.php -->
<div class="p-4 lg:p-6 bg-gradient-to-r from-blue-600 to-indigo-700 border-b border-gray-200 rounded-t-lg">
    <h1 class="text-xl font-bold text-white flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
        </svg>
        Configuration
    </h1>
</div>

<div class="bg-gray-100 p-4">
    <form action="{{ route('configs.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champ : Nom de l'application -->
        <div class="mb-4">
            <label for="app_name" class="block text-sm font-medium text-gray-700">Nom de l'application</label>
            <input type="text" name="app_name" id="app_name" value="{{ $config['APP_NAME'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Champ : Adresse -->
        <div class="mb-4">
            <label for="app_address" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" name="app_address" id="app_address" value="{{ $config['APP_ADDRESS'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Champ : Ville -->
        <div class="mb-4">
            <label for="app_city" class="block text-sm font-medium text-gray-700">Ville</label>
            <input type="text" name="app_city" id="app_city" value="{{ $config['APP_CITY'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Champ : Pays -->
        <div class="mb-4">
            <label for="app_country" class="block text-sm font-medium text-gray-700">Pays</label>
            <input type="text" name="app_country" id="app_country" value="{{ $config['APP_COUNTRY'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Champ : Téléphone -->
        <div class="mb-4">
            <label for="app_phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
            <input type="text" name="app_phone" id="app_phone" value="{{ $config['APP_PHONE'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Champ : Email -->
        <div class="mb-4">
            <label for="app_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="app_email" id="app_email" value="{{ $config['APP_EMAIL'] }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Enregistrer
            </button>
        </div>
    </form>
</div>
