<div>
    <!-- Notifications dynamiques sans rechargement de page -->
    <div x-data="{
        success: false,
        error: false,
        successMessage: '',
        errorMessage: '',
        closeAlert(type) {
            if (type === 'success') this.success = false;
            if (type === 'error') this.error = false;
            // Éviter propagation ou comportements par défaut
            return false;
        }
    }"
        x-on:config-updated.window="
            success = true;
            successMessage = $event.detail.message;
            setTimeout(() => { success = false }, 5000);
        "
        x-on:config-update-failed.window="
            error = true;
            errorMessage = $event.detail.message;
            setTimeout(() => { error = false }, 5000);
        ">

        <!-- Message de succès dynamique -->
        <div x-show="success" x-cloak
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Succès!</strong>
            <span class="block sm:inline" x-text="successMessage"></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click.prevent="closeAlert('success')">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>

        <!-- Message d'erreur dynamique -->
        <div x-show="error" x-cloak
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Erreur!</strong>
            <span class="block sm:inline" x-text="errorMessage"></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click.prevent="closeAlert('error')">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    </div>

    <div class="p-4 lg:p-6 bg-gradient-to-r from-[#00A7E1] to-[#00A7E1] border-b border-gray-200 rounded-t-lg">
        <h1 class="text-xl font-bold text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            Configuration
        </h1>
    </div>

    <div class="bg-gray-100 p-4">
        <form wire:submit.prevent="submit">
            <!-- Champ : Nom de l'application -->
            <div class="mb-4">
                <label for="app_name" class="block text-sm font-medium text-gray-700">Nom de l'application</label>
                <input type="text" wire:model.defer="app_name" id="app_name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Champ : Adresse -->
            <div class="mb-4">
                <label for="app_address" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" wire:model.defer="app_address" id="app_address"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_address')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Champ : Ville -->
            <div class="mb-4">
                <label for="app_city" class="block text-sm font-medium text-gray-700">Ville</label>
                <input type="text" wire:model.defer="app_city" id="app_city"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_city')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Champ : Pays -->
            <div class="mb-4">
                <label for="app_country" class="block text-sm font-medium text-gray-700">Pays</label>
                <input type="text" wire:model.defer="app_country" id="app_country"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_country')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Champ : Téléphone -->
            <div class="mb-4">
                <label for="app_phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" wire:model.defer="app_phone" id="app_phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Champ : Email -->
            <div class="mb-4">
                <label for="app_email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model.defer="app_email" id="app_email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                @error('app_email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Bouton de soumission avec indicateur de chargement -->
            <div class="flex justify-end">
                <button type="submit" 
                    wire:loading.attr="disabled" 
                    wire:target="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00A7E1] transition-colors duration-200
                    bg-[#00A7E1] hover:bg-indigo-700 
                    disabled:bg-indigo-300 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.class="hidden" wire:target="submit">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-2 hidden" fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.class.remove="hidden" wire:target="submit">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span wire:loading.remove wire:target="submit">Enregistrer</span>
                    <span wire:loading wire:target="submit">Soumission en cours...</span>
                </button>
            </div>
        </form>
    </div>
</div>
