<div>
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
                                                        <span class="text-xs text-gray-800">{{ $attachment->getClientOriginalName() }}</span>
                                                        <button wire:click="removeAttachment({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
