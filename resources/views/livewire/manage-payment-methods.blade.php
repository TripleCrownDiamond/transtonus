<div>
    <div wire:loading.delay wire:target="$refresh" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg flex items-center space-x-3">
            <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700 font-medium">Chargement...</span>
        </div>
    </div>
    
    <!-- Notifications dynamiques sans rechargement de page -->
    <div x-data="{
        success: false,
        error: false,
        successMessage: '',
        errorMessage: '',
        formVisible: @entangle('showForm'),
        closeAlert(type) {
            if (type === 'success') this.success = false;
            if (type === 'error') this.error = false;
            return false;
        }
    }"
        x-on:payment-method-saved.window="
            success = true;
            successMessage = $event.detail.message;
            setTimeout(() => { success = false }, 5000);
        "
        x-on:payment-method-error.window="
            error = true;
            errorMessage = $event.detail.message;
            setTimeout(() => { error = false }, 5000);
        ">

        <!-- Message de succès dynamique -->
        <div x-show="success" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
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

         <!-- Espace entre les messages -->
        <div class="mb-4"></div>

        <!-- Message d'erreur dynamique -->
        <div x-show="error" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
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

         <!-- Espace entre les messages -->
        <div class="mb-4"></div>

        <!-- Section d'en-tête -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Gestion des méthodes de paiement</h2>
                <div>
                    <!-- For the Add/Close form button -->
                    <button wire:click="toggleForm" 
                            wire:loading.attr="disabled"
                            class="px-4 py-2 rounded-md shadow-sm inline-flex items-center justify-center transition-colors duration-150 border {{ $showForm ? 'bg-gray-300 text-gray-600 cursor-not-allowed border-gray-300' : 'bg-white text-blue-600 hover:bg-blue-50 border-blue-300' }}"
                            {{ $showForm || $isEditing ? 'disabled' : '' }}>
                        @if(!$showForm)
                            <span wire:loading.remove wire:target="toggleForm" class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Ajouter une méthode de paiement</span>
                            </span>
                            <span wire:loading wire:target="toggleForm" class="inline-flex items-center">
                                <span>Chargement...</span>
                            </span>
                        @else
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Fermer le formulaire</span>
                            </span>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <!-- Formulaire d'ajout/modification -->
        <div x-show="formVisible" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4"
            class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                {{ $isEditing ? 'Modifier le moyen de paiement' : 'Ajouter un nouveau moyen de paiement' }}
            </h3>
            
            <form wire:submit.prevent="savePaymentMethod">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" wire:model="name" id="name"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                        <input type="text" wire:model="code" id="code"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border">
                        <p class="mt-1 text-xs text-gray-500">Identifiant unique utilisé dans le système pour référencer cette méthode de paiement</p>
                        @error('code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                      <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" id="description" rows="4"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border"
                            placeholder="Vous pouvez inclure des informations de paiement comme IBAN, adresse de wallet, etc."></textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Vous pouvez utiliser du texte formaté: <br>
                            - Utilisez *texte* pour <em>italique</em><br>
                            - Utilisez **texte** pour <strong>gras</strong><br>
                            - Utilisez _texte_ pour <u>souligner</u><br>
                            - Appuyez sur Entrée pour créer une nouvelle ligne
                        </p>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Actif -->
                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" wire:model="is_active" id="is_active"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded border">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Actif
                            </label>
                        </div>
                        @error('is_active') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" wire:click="cancelForm"
                        wire:loading.attr="disabled"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3 disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center">
                        <span wire:loading.remove wire:target="cancelForm">Annuler</span>
                        <span wire:loading wire:target="cancelForm">Annulation...</span>
                    </button>
                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="savePaymentMethod">
                            {{ $isEditing ? 'Mettre à jour' : 'Enregistrer' }}
                        </span>
                        <span wire:loading wire:target="savePaymentMethod">Traitement en cours...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tableau des moyens de paiement -->
        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($paymentMethods as $method)
                            <tr class="{{ $isEditing && $paymentMethodId == $method->id ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-50' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $method->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $method->code }}
                                </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                    @if($method->description)
                                        <div class="whitespace-pre-line">
                                            {!! nl2br(preg_replace(['/\*\*(.*?)\*\*/', '/\*(.*?)\*/', '/\_(.*?)\_/'], ['<strong>$1</strong>', '<em>$1</em>', '<u>$1</u>'], e($method->description))) !!}
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $method->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $method->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($isEditing && $paymentMethodId == $method->id)
                                        <span class="text-blue-600 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            En cours d'édition
                                        </span>
                                    @else
                                        <button wire:click="editPaymentMethod({{ $method->id }})" 
                                               wire:loading.attr="disabled"
                                               class="text-indigo-600 hover:text-indigo-900 mr-3 disabled:opacity-50">
                                            <span wire:loading.remove wire:target="editPaymentMethod({{ $method->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </span>
                                            <span wire:loading wire:target="editPaymentMethod({{ $method->id }})" class="flex items-center">
                                                <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <button wire:click="showDeleteModal({{ $method->id }})" 
                                               wire:loading.attr="disabled"
                                               class="text-red-600 hover:text-red-900 disabled:opacity-50">
                                            <span wire:loading.remove wire:target="showDeleteModal({{ $method->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </span>
                                            <span wire:loading wire:target="showDeleteModal({{ $method->id }})" class="flex items-center">
                                                <svg class="animate-spin h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Aucun moyen de paiement trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                @if($paymentMethods->hasPages())
                    <div class="pagination-wrapper">
                        {{ $paymentMethods->links() }}
                    </div>
                @else
                    <div class="text-sm text-gray-500 py-2">
                        Affichage de {{ $paymentMethods->count() }} {{ $paymentMethods->count() > 1 ? 'méthodes de paiement' : 'méthode de paiement' }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal de confirmation de suppression -->
        <div x-show="$wire.showDeleteConfirmation" x-cloak class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Confirmer la suppression
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Êtes-vous sûr de vouloir supprimer ce moyen de paiement? Cette action est irréversible.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="confirmDelete" type="button"
                            wire:loading.attr="disabled"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                            <span wire:loading.remove wire:target="confirmDelete">Supprimer</span>
                            <span wire:loading wire:target="confirmDelete">Suppression...</span>
                        </button>
                        <button wire:click="cancelDelete" type="button"
                            wire:loading.attr="disabled"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                            <span wire:loading.remove wire:target="cancelDelete">Annuler</span>
                            <span wire:loading wire:target="cancelDelete">Annulation...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
