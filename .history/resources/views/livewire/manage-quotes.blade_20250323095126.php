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
        <div class="p-4 lg:p-6 bg-gradient-to-r from-blue-600 to-indigo-700 border-b border-gray-200 rounded-t-lg">
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
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Nom, email, entreprise...">
                </div>

                <!-- Filtre par statut -->
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par statut</label>
                    <select wire:model.live="statusFilter" id="statusFilter"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'created_at' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            Date {{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                        </button>
                        <button wire:click="sortBy('name')" 
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'name' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            Nom {{ $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' }}
                        </button>
                        <button wire:click="sortBy('status')" 
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $sortField === 'status' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($quotes as $quote)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $quote->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $quote->email }}
                                            </div>
                                            @if ($quote->company)
                                                <div class="text-xs text-gray-500">
                                                    {{ $quote->company }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $quote->service_type }}</div>
                                    @if ($quote->origin && $quote->destination)
                                        <div class="text-xs text-gray-500">
                                            {{ $quote->origin }} → {{ $quote->destination }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $quote->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <select 
                                            wire:change="updateStatus({{ $quote->id }}, $event.target.value)"
                                            wire:loading.attr="disabled"
                                            class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500
                                                {{ $quote->status === 'pending' ? 'bg-yellow-50 text-yellow-800' : 
                                                   ($quote->status === 'in_progress' ? 'bg-blue-50 text-blue-800' : 
                                                   'bg-green-50 text-green-800') }}">
                                            <option value="pending" {{ $quote->status === 'pending' ? 'selected' : '' }}>
                                                En attente
                                            </option>
                                            <option value="in_progress" {{ $quote->status === 'in_progress' ? 'selected' : '' }}>
                                                En cours
                                            </option>
                                            <option value="completed" {{ $quote->status === 'completed' ? 'selected' : '' }}>
                                                Terminé
                                            </option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="showDetails({{ $quote->id }})" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Gérer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Aucune demande de devis trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $quotes->links() }}
            </div>
        </div>

        <!-- Modal de détails du devis -->
        <div x-data="{ open: @entangle('showQuoteDetails') }" x-show="open" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay de fond -->
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Centrer le modal -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Contenu du modal -->
                <div x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    
                    @if($selectedQuote)
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center" id="modal-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Détails de la demande de devis #{{ $selectedQuote->id }}
                                </h3>
                                
                                <!-- Informations du client -->
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900">Informations du client</h4>
                                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Nom</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->email }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Téléphone</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->phone }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Entreprise</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->company ?: 'Non spécifié' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Détails de la demande -->
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900">Détails de la demande</h4>
                                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Type de service</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->service_type }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Statut</p>
                                            <p class="text-sm font-medium">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $selectedQuote->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                    ($selectedQuote->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                                    'bg-green-100 text-green-800') }}">
                                                    {{ $selectedQuote->status === 'pending' ? 'En attente' : 
                                                    ($selectedQuote->status === 'in_progress' ? 'En cours' : 'Terminé') }}
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Origine</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->origin ?: 'Non spécifié' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Destination</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->destination ?: 'Non spécifié' }}</p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <p class="text-sm text-gray-500">Détails</p>
                                            <p class="text-sm font-medium whitespace-pre-line">{{ $selectedQuote->details }}</p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <p class="text-sm text-gray-500">Date de demande</p>
                                            <p class="text-sm font-medium">{{ $selectedQuote->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Formulaire d'envoi d'email -->
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900">Envoyer un devis par email</h4>
                                    <div class="mt-2">
                                        <div class="mb-4">
                                            <label for="emailSubject" class="block text-sm font-medium text-gray-700">Sujet</label>
                                            <input type="text" wire:model="emailSubject" id="emailSubject"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error('emailSubject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="emailContent" class="block text-sm font-medium text-gray-700">Contenu</label>
                                            <div wire:ignore>
                                                <textarea id="emailContent" wire:model="emailContent" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                            </div>
                                            @error('emailContent') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="attachments" class="block text-sm font-medium text-gray-700">Pièces jointes</label>
                                            <input type="file" wire:model="attachments" id="attachments" multiple
                                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            @error('attachments.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            
                                            <div class="mt-2 flex flex-wrap gap-2">
                                                @if($attachments)
                                                    @foreach($attachments as $index => $attachment)
                                                        <div class="flex items-center bg-gray-100 rounded-md px-3 py-1">
                                                            <span class="text-xs text-gray-800">{{ $attachment->getClientOriginalName() }}</span
