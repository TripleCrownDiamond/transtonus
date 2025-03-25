<div>
    <!-- Remplacer les alertes de session par des alertes Alpine.js -->
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
        x-on:language-updated.window="
            success = true;
            successMessage = $event.detail.message;
            setTimeout(() => { success = false }, 5000);
        "
        x-on:language-update-failed.window="
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
                <!-- Icône SVG représentant des langues/traductions -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
                </svg>
                Gestion des langues
            </h1>
        </div>

        <div class="bg-gray-100 p-4">
            <!-- Ajouter une nouvelle langue -->
            <div class="mb-4">
                <label for="newLanguage" class="block text-sm font-medium text-gray-700 mb-1">Ajouter une nouvelle
                    langue</label>
                <div class="flex">
                    <input type="text" wire:model="newLanguage" id="newLanguage"
                        class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Code de langue (ex: en, es, de)">
                    <button wire:click="addLanguage" 
                        wire:loading.attr="disabled" 
                        wire:target="addLanguage"
                        :disabled="@js($isAddingLanguage)"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-indigo-300 disabled:cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" wire:loading.class="hidden" wire:target="addLanguage">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-1 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" wire:loading.class.remove="hidden" wire:target="addLanguage">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span wire:loading.remove wire:target="addLanguage">Ajouter</span>
                        <span wire:loading wire:target="addLanguage">Ajout...</span>
                    </button>
                </div>
            </div>

            <!-- Sélectionner une langue -->
            <div class="mb-4">
                <label for="selectedLanguage" class="block text-sm font-medium text-gray-700 mb-1">Sélectionner une
                    langue</label>
                <div class="flex">
                    <select wire:model="selectedLanguage" wire:change="loadTranslations($event.target.value)"
                        id="selectedLanguage"
                        class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach ($languages as $language)
                            <option value="{{ $language }}">{{ $language }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Bouton de suppression de langue -->
                    <button wire:click="confirmDeleteLanguage('{{ $selectedLanguage }}')"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 {{ $selectedLanguage === 'fr' ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $selectedLanguage === 'fr' ? 'disabled' : '' }}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Supprimer
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Note: La langue française (fr) ne peut pas être supprimée car c'est la langue principale.
                </p>
            </div>

            <!-- Modal de confirmation de suppression -->
            <div x-data="{ open: @entangle('showDeleteConfirmation') }" x-show="open" x-cloak
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
                                            Êtes-vous sûr de vouloir supprimer la langue <span class="font-semibold">{{ $languageToDelete }}</span> ?
                                            Cette action est irréversible et supprimera toutes les traductions associées.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="deleteLanguage" 
                                wire:loading.attr="disabled" 
                                wire:target="deleteLanguage"
                                :disabled="@js($isDeletingLanguage)"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:bg-red-300 disabled:cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" wire:loading.class="hidden" wire:target="deleteLanguage">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-1 hidden" fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor" wire:loading.class.remove="hidden" wire:target="deleteLanguage">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span wire:loading.remove wire:target="deleteLanguage">Supprimer</span>
                                <span wire:loading wire:target="deleteLanguage">Suppression...</span>
                            </button>
                            <button wire:click="cancelDeleteLanguage" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Traductions pour la langue sélectionnée -->
            <div class="mb-4">
                <h2 class="text-lg font-medium text-gray-900 mb-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    Traductions pour {{ $selectedLanguage }}
                </h2>

                <div class="bg-white rounded-lg shadow-sm p-4">
                    <!-- Filtre de recherche avec bouton d'annulation -->
                    <div class="mb-4">
                        <label for="searchFilter" class="block text-sm font-medium text-gray-700 mb-1">Rechercher une clé ou valeur</label>
                        <div class="flex">
                            <input type="text" wire:model.live="searchFilter" id="searchFilter"
                                class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Filtrer par clé ou valeur de traduction...">
                            <button wire:click="resetFilter"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md font-semibold {{ !$searchFilter ? 'text-gray-500 bg-gray-200' : 'text-white bg-gray-800' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                {{ !$searchFilter ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Annuler
                            </button>
                        </div>
                    </div>
                    @if (is_array($this->filteredTranslations) && count($this->filteredTranslations) > 0)
                        <!-- Affichage des traductions filtrées -->
                        <div class="mt-4 space-y-6">
                            @php
                                $currentSection = '';
                                $characterLimit = 100; // Définir la limite de caractères pour utiliser un textarea
                            @endphp

                            @foreach ($this->filteredTranslations as $key => $translation)
                                <!-- Afficher chaque traduction -->
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <!-- Clé de traduction et traduction française au-dessus -->
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-700 block mb-1">{{ $key }}</span>
                                        @if (isset($frenchTranslations[$key]))
                                            <div class="text-sm text-gray-500 mb-2">
                                                <span class="font-medium">Français :</span>
                                                {{ $frenchTranslations[$key] }}
                                            </div>
                                        @endif
                                        
                                        <!-- Valeur actuelle dans la langue sélectionnée -->
                                        <div class="text-sm bg-gray-50 border-l-4 border-indigo-500 pl-3 py-2 rounded mb-2">
                                            <span class="font-medium text-indigo-700">Valeur actuelle :</span> 
                                            <span class="text-gray-800">{{ isset($translations[$key]) && !empty($translations[$key]) ? $translations[$key] : 'Non défini' }}</span>
                                        </div>
                                    </div>
                                    <!-- Champ de saisie de traduction en dessous - textarea pour les longues valeurs -->
                                    <div>
                                        @if(isset($frenchTranslations[$key]) && strlen($frenchTranslations[$key]) > $characterLimit)
                                            <textarea wire:model="translations.{{ $key }}"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                placeholder="Traduction pour {{ $key }}"
                                                rows="{{ ceil(strlen($frenchTranslations[$key]) / 100) + 1 }}"
                                                style="min-height: 80px;"></textarea>
                                        @else
                                            <input type="text" wire:model="translations.{{ $key }}"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                placeholder="Traduction pour {{ $key }}">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-4 text-center text-gray-500">
                            Aucune traduction trouvée pour la langue {{ $selectedLanguage }}.
                        </div>
                    @endif

                    <!-- Bouton de sauvegarde -->
                    <div class="mt-6 text-right">
                        <!-- Bouton de sauvegarde -->
                        <div class="mt-6 text-right">
                            <button wire:click="saveTranslations" 
                                wire:loading.attr="disabled" 
                                wire:target="saveTranslations"
                                :disabled="@js($isSaving)"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-indigo-300 disabled:cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" wire:loading.class="hidden" wire:target="saveTranslations">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-2 hidden" fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor" wire:loading.class.remove="hidden" wire:target="saveTranslations">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span wire:loading.remove wire:target="saveTranslations">Enregistrer les modifications</span>
                                <span wire:loading wire:target="saveTranslations">Enregistrement...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
