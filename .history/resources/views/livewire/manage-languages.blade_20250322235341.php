<div>
    <!-- Afficher un message de succès ou d'erreur via Livewire dispatch -->
    @if ($message = session('message'))
        <div class="{{ $message['type'] === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700' }} border px-4 py-3 rounded relative mb-4"
            role="alert">
            <strong class="font-bold">{{ $message['type'] === 'success' ? 'Succès!' : 'Erreur!' }}</strong>
            <span class="block sm:inline">{{ $message['message'] }}</span>
        </div>
    @endif

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
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajouter
                </button>
            </div>
        </div>

        <!-- Sélectionner une langue -->
        <div class="mb-4">
            <label for="selectedLanguage" class="block text-sm font-medium text-gray-700 mb-1">Sélectionner une
                langue</label>
            <select wire:model.live="selectedLanguage" wire:change="loadTranslations($event.target.value)"
                id="selectedLanguage"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach ($languages as $language)
                    <option value="{{ $language }}">{{ $language }}</option>
                @endforeach
            </select>
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
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-r-md font-semibold {{ !$searchFilter ? 'text-gray-500 bg-gray-200' : 'text-white bg-gray-800' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
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
                @if (is_array($filteredTranslations) && count($filteredTranslations) > 0)
                    <!-- Affichage des traductions filtrées -->
                    <div class="mt-4 space-y-6">
                        @foreach ($filteredTranslations as $key => $translation)
                            <!-- Afficher chaque traduction -->
                            <div class="p-4 bg-white rounded-lg shadow-sm">
                                <!-- Clé de traduction et traduction française au-dessus -->
                                <div class="mb-3">
                                    <span
                                        class="text-sm font-medium text-gray-700 block mb-1">{{ $key }}</span>
                                    @if (isset($frenchTranslations[$key]))
                                        <div class="text-sm text-gray-500 mb-2">
                                            <span class="font-medium">Français :</span> {{ $frenchTranslations[$key] }}
                                        </div>
                                    @endif
                                </div>
                                <!-- Champ de saisie de traduction en dessous -->
                                <div>
                                    <input type="text" wire:model="translations.{{ $key }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Traduction pour {{ $key }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-4 text-center text-gray-500">
                        Aucune traduction trouvée pour la langue {{ $selectedLanguage }} avec ce filtre.
                    </div>
                @endif

                <!-- Bouton de sauvegarde -->
                <div class="mt-6 text-right">
                    <button wire:click="saveTranslations" wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-indigo-300"
                        :disabled="isSaving">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span wire:loading.remove>Enregistrer les modifications</span>
                        <span wire:loading>Enregistrement...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
