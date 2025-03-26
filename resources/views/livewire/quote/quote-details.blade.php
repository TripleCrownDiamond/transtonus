<div>
    @if ($showQuoteDetails && $selectedQuote)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50 flex items-center justify-center"
            x-data>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full">
                <!-- En-tête du modal -->
                <div class="bg-[#00A7E1] px-4 py-3 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-white">
                        Détails du devis #{{ $selectedQuote->id }}
                    </h3>
                    <button wire:click="closeDetails" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenu du modal -->
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Informations du client -->
                    <div class="mb-4">
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
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $selectedQuote->status === 'pending'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($selectedQuote->status === 'in_progress'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                        {{ $selectedQuote->status === 'pending'
                                            ? 'En attente'
                                            : ($selectedQuote->status === 'in_progress'
                                                ? 'En cours'
                                                : 'Terminé') }}
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
                            <div>
                                <p class="text-sm text-gray-500">Langue</p>
                                <p class="text-sm font-medium">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ strtoupper($selectedQuote->locale) }}
                                    </span>
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Détails</p>
                                <p class="text-sm font-medium whitespace-pre-line">{{ $selectedQuote->details }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Date de demande</p>
                                <p class="text-sm font-medium">{{ $selectedQuote->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="closeDetails" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00A7E1] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
