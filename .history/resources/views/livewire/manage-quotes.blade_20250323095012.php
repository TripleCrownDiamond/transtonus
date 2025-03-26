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
            return false;
        }
    }"
        x-on:quote-updated.window="
            success = true;
            successMessage = $event.detail.message;
            setTimeout(() => { success = false }, 5000);
        "
        x-on:quote-update-failed.window="
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

        <!-- Section d'en-tête -->
        <div class="p-4 lg:p-6 bg-gradient-to-r from-[#00A7E1] to-[#00A7E1] border-b border-gray-200 rounded-t-lg">
            <h1 class="text-xl font-bold text-white flex items-center">
                <!-- Icône SVG représentant des devis -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Gestion des demandes de devis
            </h1>
        </div>

        <div class="bg-gray-100 p-4">
            <!-- Filtres et recherche -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Recherche -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input type="text" wire:model.live.debounce.300ms="search" id="search"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm"
                        placeholder="Nom, email, entreprise...">
                </div>

                <!-- Filtre par statut -->
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par statut</label>
                    <select wire:model.live="statusFilter" id="statusFilter"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00A7E1] focus:ring-[#00A7E1] sm:text-sm">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>

                <!-- Tri -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tri</label>
                    <div class="flex space-x-2">
                        <button wire:click="sortBy('created_at')" 
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'created_at' ? 'bg-[#00A7E1] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            Date {{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                        </button>
                        <button wire:click="sortBy('name')" 
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'name' ? 'bg-[#00A7E1] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            Nom {{ $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                        </button>
                        <button wire:click="sortBy('status')" 
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'status' ? 'bg-[#00A7E1] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            Statut {{ $sortField === 'status' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Liste des demandes de devis -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
