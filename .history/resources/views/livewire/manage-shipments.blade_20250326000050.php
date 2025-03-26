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
        x-on:shipment-saved.window="
            success = true;
            successMessage = $event.detail.message;
            setTimeout(() => { success = false }, 5000);
        "
        x-on:shipment-error.window="
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

        <!-- Section d'en-tête avec gradient et icône -->
        <div class="p-4 lg:p-6 bg-gradient-to-r from-[#00A7E1] to-[#0087C1] border-b border-gray-200 rounded-t-lg">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                    <h2 class="text-xl font-semibold text-white">Gestion des expéditions</h2>
                </div>
                <div>
                    <button wire:click="toggleForm" wire:loading.attr="disabled"
                        class="px-4 py-2 rounded-md shadow-sm flex items-center transition-colors duration-150 bg-white text-[#5E0035] hover:bg-gray-100 border border-transparent"
                        {{ $showForm ? 'disabled' : '' }}>
                        @if (!$showForm)
                            <span wire:loading.remove wire:target="toggleForm" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Ajouter une expédition</span>
                            </span>
                            <span wire:loading wire:target="toggleForm" class="inline-flex items-center">
                                Chargement...
                            </span>
                        @else
                            <span wire:loading.remove wire:target="toggleForm" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Fermer le formulaire</span>
                            </span>
                            <span wire:loading wire:target="toggleForm" class="inline-flex items-center">
                                Chargement...
                            </span>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        @if ($showForm)
            <!-- Formulaire d'ajout/modification d'expédition -->
            <div x-data="{ activeTab: 'shipment' }" x-show="@entangle('showForm')" x-cloak
                class="bg-white p-4 lg:p-6 border-b border-gray-200 shadow-inner">
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="mr-2">
                            <button @click="activeTab = 'shipment'"
                                :class="{ 'text-[#5E0035] border-[#00A7E1]': activeTab === 'shipment', 'text-gray-500 hover:text-gray-600 border-transparent': activeTab !== 'shipment' }"
                                class="inline-block p-4 border-b-2 rounded-t-lg">
                                Informations d'expédition
                            </button>
                        </li>
                        <li class="mr-2">
                            <button @click="activeTab = 'payment'"
                                :class="{ 'text-[#5E0035] border-[#00A7E1]': activeTab === 'payment', 'text-gray-500 hover:text-gray-600 border-transparent': activeTab !== 'payment' }"
                                class="inline-block p-4 border-b-2 rounded-t-lg">
                                Informations de paiement
                            </button>
                        </li>
                    </ul>
                </div>

                <form wire:submit.prevent="saveShipment">
                    <!-- Onglet Informations d'expédition -->
                    <div x-show="activeTab === 'shipment'">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="tracking_number" class="block text-sm font-medium text-gray-700 mb-1">Numéro
                                    de suivi</label>
                                <input type="text" id="tracking_number" wire:model="tracking_number"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="TRK12345678">
                                @error('tracking_number')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                                <select id="status" wire:model="status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="processing">En traitement</option>
                                    <option value="in_transit">En transit</option>
                                    <option value="out_for_delivery">En cours de livraison</option>
                                    <option value="delivered">Livré</option>
                                    <option value="delayed">Retardé</option>
                                    <option value="exception">Exception</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="origin"
                                    class="block text-sm font-medium text-gray-700 mb-1">Origine</label>
                                <input type="text" id="origin" wire:model="origin"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Paris, France">
                                @error('origin')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="destination"
                                    class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
                                <input type="text" id="destination" wire:model="destination"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="New York, USA">
                                @error('destination')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="current_location"
                                    class="block text-sm font-medium text-gray-700 mb-1">Localisation actuelle</label>
                                <input type="text" id="current_location" wire:model="current_location"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Madrid, Espagne">
                                @error('current_location')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-1">Date
                                    de départ</label>
                                <input type="date" id="departure_date" wire:model="departure_date"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('departure_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="estimated_arrival_date"
                                    class="block text-sm font-medium text-gray-700 mb-1">Date d'arrivée estimée</label>
                                <input type="date" id="estimated_arrival_date" wire:model="estimated_arrival_date"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @error('estimated_arrival_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="sender_name"
                                    class="block text-sm font-medium text-gray-700 mb-1">Expéditeur</label>
                                <input type="text" id="sender_name" wire:model="sender_name"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Nom de l'expéditeur">
                                @error('sender_name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="locale" class="block text-sm font-medium text-gray-700 mb-1">Langue du
                                    client</label>
                                <select id="locale" wire:model="locale"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @foreach ($availableLocales as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('locale')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <!-- Recipient Name -->
                                <label for="recipient_name" class="block text-sm font-medium text-gray-700 mb-1">Nom
                                    du destinataire</label>
                                <input type="text" wire:model="recipient_name" id="recipient_name"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Nom du destinataire">
                                @error('recipient_name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <!-- Recipient Email -->
                                <label for="recipient_email"
                                    class="block text-sm font-medium text-gray-700 mb-1">Email du destinataire</label>
                                <input type="email" wire:model="recipient_email" id="recipient_email"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="email@exemple.com">
                                @error('recipient_email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">

                            <!-- Additional Information Field -->
                            <div class="mb-4" x-data="{ showPreview: false, formattedText: '', copySuccess: false }">
                                <label for="additional_info"
                                    class="block text-sm font-medium text-gray-700 mb-1">Informations
                                    complémentaires</label>
                                <div class="text-xs text-gray-500 mb-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Vous pouvez copier/coller et modifier les exemples de syntaxe ci-dessous
                                </div>
                                <div class="relative">
                                    <textarea id="additional_info" wire:model="additional_info" rows="6"
                                        x-on:input="formattedText = $event.target.value"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        placeholder="Informations additionnelles:
- Comportement à tenir en présence du livreur
- Instructions spéciales pour la livraison
- Type de marchandise (ex: Voiture - Marque, Modèle)
- Assurance de la marchandise
- Poids et dimensions
- Autres informations utiles"></textarea>
                                    <div class="absolute right-2 bottom-2 flex space-x-2">
                                        <button type="button" @click="showPreview = !showPreview"
                                            class="px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded hover:bg-gray-300 transition-colors duration-150">
                                            <span x-text="showPreview ? 'Masquer l\'aperçu' : 'Voir l\'aperçu'"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Aperçu du texte formaté -->
                                <div x-show="showPreview" x-cloak class="mt-2 p-3 border rounded-md bg-gray-50">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-sm font-medium text-gray-700">Aperçu:</h4>
                                        <button
                                            @click="navigator.clipboard.writeText(formattedText); copySuccess = true; setTimeout(() => copySuccess = false, 2000)"
                                            class="px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded hover:bg-gray-300 transition-colors duration-150 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                            </svg>
                                            <span x-text="copySuccess ? 'Copié!' : 'Copier'"></span>
                                        </button>
                                    </div>
                                    <div x-html="formattedText
                                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                                        .replace(/\*(.*?)\*/g, '<em>$1</em>')
                                        .replace(/_(.*?)_/g, '<u>$1</u>')
                                        .replace(/\[color:(.*?)\](.*?)\[\/color\]/g, '<span style=\'color:$1\'>$2</span>')
                                        .replace(/## (.*?)(?:\n|$)/g, '<h2 class=\'text-xl font-bold my-2\'>$1</h2>')
                                        .replace(/### (.*?)(?:\n|$)/g, '<h3 class=\'text-lg font-bold my-1\'>$1</h3>')
                                        .replace(/\[link:(.*?)\](.*?)\[\/link\]/g, '<a href=\'$1\' class=\'text-blue-600 hover:underline\' target=\'_blank\'>$2</a>')
                                        .replace(/^- (.*?)$/gm, '<li>$1</li>')
                                        .replace(/^([0-9]+)\. (.*?)$/gm, '<li>$2</li>')
                                        .replace(/<li>(.*?)<\/li>/g, function(match) {
                                            return match.replace(/\n/g, '');
                                        })
                                        .replace(/(<li>.*?<\/li>)+/g, '<ul class=\'list-disc pl-5 my-2\'>$&</ul>')
                                        .replace(/\n/g, '<br>')"
                                        class="text-sm text-gray-800"></div>
                                </div>

                                <!-- Exemples de syntaxe copiables -->
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <div class="text-xs bg-gray-50 p-2 rounded border">
                                        <div class="font-medium text-gray-700 mb-1 flex justify-between">
                                            <span>Formatage de texte</span>
                                            <button
                                                @click="navigator.clipboard.writeText('**texte en gras**\n*texte en italique*\n_texte souligné_'); copySuccess = true; setTimeout(() => copySuccess = false, 2000)"
                                                class="text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <code class="block whitespace-pre-wrap">
                                            <span class="text-purple-600">**texte en gras**</span>
                                            <span class="text-green-600">*texte en italique*</span>
                                            <span class="text-blue-600">_texte souligné_</span>
                                        </code>
                                    </div>
                                    <div class="text-xs bg-gray-50 p-2 rounded border">
                                        <div class="font-medium text-gray-700 mb-1 flex justify-between">
                                            <span>Titres</span>
                                            <button
                                                @click="navigator.clipboard.writeText('## Titre niveau 2\n### Titre niveau 3'); copySuccess = true; setTimeout(() => copySuccess = false, 2000)"
                                                class="text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <code class="block whitespace-pre-wrap">
                                            <span class="text-red-600">## Titre niveau 2</span>
                                            <span class="text-orange-600">### Titre niveau 3</span>
                                        </code>
                                    </div>
                                    <div class="text-xs bg-gray-50 p-2 rounded border">
                                        <div class="font-medium text-gray-700 mb-1 flex justify-between">
                                            <span>Listes</span>
                                            <button
                                                @click="navigator.clipboard.writeText('- Élément à puce 1\n- Élément à puce 2\n\n1. Élément numéroté 1\n2. Élément numéroté 2'); copySuccess = true; setTimeout(() => copySuccess = false, 2000)"
                                                class="text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <code class="block whitespace-pre-wrap">
                                            <span class="text-teal-600">- Élément à puce 1</span>
                                            <span class="text-teal-600">- Élément à puce 2</span>

                                            <span class="text-indigo-600">1. Élément numéroté 1</span>
                                            <span class="text-indigo-600">2. Élément numéroté 2</span>
                                        </code>
                                    </div>
                                    <div class="text-xs bg-gray-50 p-2 rounded border">
                                        <div class="font-medium text-gray-700 mb-1 flex justify-between">
                                            <span>Couleur et liens</span>
                                            <button
                                                @click="navigator.clipboard.writeText('[color:red]texte en rouge[/color]\n[link:https://exemple.com]texte du lien[/link]'); copySuccess = true; setTimeout(() => copySuccess = false, 2000)"
                                                class="text-blue-500 hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <code class="block whitespace-pre-wrap">
                                            <span class="text-pink-600">[color:red]texte en rouge[/color]</span>
                                            <span class="text-blue-600">[link:https://exemple.com]texte du
                                                lien[/link]</span>
                                        </code>
                                    </div>
                                </div>

                                @error('additional_info')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Onglet Informations de paiement -->
                    <div x-show="activeTab === 'payment'">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="amount"
                                    class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
                                <input type="number" step="0.01" id="amount" wire:model="amount"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="100.00">
                                @error('amount')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="currency_id"
                                    class="block text-sm font-medium text-gray-700 mb-1">Devise</label>
                                <select id="currency_id" wire:model="currency_id"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Sélectionner une devise</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->code }}
                                            ({{ $currency->symbol }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('currency_id')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="percentage"
                                    class="block text-sm font-medium text-gray-700 mb-1">Pourcentage</label>
                                <select id="percentage" wire:model="percentage"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @foreach ($percentageOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}%</option>
                                    @endforeach
                                </select>
                                @error('percentage')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_method"
                                    class="block text-sm font-medium text-gray-700 mb-1">Méthode de paiement</label>
                                <select id="payment_method" wire:model="payment_method"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Sélectionner une méthode</option>
                                    @foreach ($paymentMethods as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('payment_method')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="payment_status"
                                    class="block text-sm font-medium text-gray-700 mb-1">Statut du paiement</label>
                                <select id="payment_status" wire:model="payment_status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="pending">En attente</option>
                                    <option value="paid">Payé</option>
                                    <option value="failed">Échoué</option>
                                </select>
                                @error('payment_status')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="instructions"
                                class="block text-sm font-medium text-gray-700 mb-1">Instructions de paiement</label>
                            <textarea id="instructions" wire:model="instructions" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#5E0035] focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Instructions spécifiques pour le paiement..."></textarea>
                            <p class="mt-1 text-xs text-gray-500">
                                Vous pouvez utiliser du texte formaté: <br>
                                - Utilisez *texte* pour <em>italique</em><br>
                                - Utilisez **texte** pour <strong>gras</strong><br>
                                - Utilisez _texte_ pour <u>souligner</u><br>
                                - Appuyez sur Entrée pour créer une nouvelle ligne
                            </p>
                            @error('instructions')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" wire:click="cancelForm" wire:loading.attr="disabled"
                            wire:loading.class="bg-gray-300 cursor-not-allowed opacity-70"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-150">
                            <span wire:loading.remove wire:target="cancelForm">
                                Annuler
                            </span>
                            <span wire:loading wire:target="cancelForm">
                                Annulation...
                            </span>
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            wire:loading.class="bg-blue-400 cursor-not-allowed opacity-80"
                            class="px-4 py-2 bg-[#00A7E1] text-white rounded-md hover:bg-[#0087C1] transition-colors duration-150">
                            <span wire:loading.remove wire:target="saveShipment">
                                {{ $isEditing ? 'Mettre à jour' : 'Enregistrer' }}
                            </span>
                            <span wire:loading wire:target="saveShipment">
                                Enregistrement en cours...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

        @endif

        <!-- Tableau des expéditions -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Numéro de suivi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Origine / Destination
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dates
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paiement
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($shipments as $shipment)
                        <tr
                            class="{{ $isEditing && $shipmentId == $shipment->id ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $shipment->tracking_number }}</div>
                                <div class="text-xs text-gray-500">
                                    <span class="font-medium">De:</span> {{ $shipment->sender_name }}
                                    <br>
                                    <span class="font-medium">À:</span> {{ $shipment->recipient_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Origine:</span> {{ $shipment->origin }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Destination:</span> {{ $shipment->destination }}
                                </div>
                                @if ($shipment->current_location)
                                    <div class="text-xs text-gray-500 mt-1">
                                        <span class="font-medium">Position actuelle:</span>
                                        {{ $shipment->current_location }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Départ:</span>
                                    {{ $shipment->departure_date->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Arrivée estimée:</span>
                                    {{ $shipment->estimated_arrival_date->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClasses = [
                                        'processing' => 'bg-yellow-100 text-yellow-800',
                                        'in_transit' => 'bg-blue-100 text-blue-800',
                                        'out_for_delivery' => 'bg-indigo-100 text-indigo-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'delayed' => 'bg-orange-100 text-orange-800',
                                        'exception' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusLabels = [
                                        'processing' => 'En traitement',
                                        'in_transit' => 'En transit',
                                        'out_for_delivery' => 'En cours de livraison',
                                        'delivered' => 'Livré',
                                        'delayed' => 'Retardé',
                                        'exception' => 'Exception',
                                    ];
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$shipment->status] }}">
                                    {{ $statusLabels[$shipment->status] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($shipment->payments->count() > 0)
                                    @php
                                        $payment = $shipment->payments->first();
                                        $paymentStatusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'paid' => 'bg-green-100 text-green-800',
                                            'failed' => 'bg-red-100 text-red-800',
                                        ];
                                        $paymentStatusLabels = [
                                            'pending' => 'En attente',
                                            'paid' => 'Payé',
                                            'failed' => 'Échoué',
                                        ];
                                    @endphp
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($payment->amount, 2) }} {{ $payment->currency->symbol }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentStatusClasses[$payment->status] }}">
                                            {{ $paymentStatusLabels[$payment->status] }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500">Aucun paiement</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if ($isEditing && $shipmentId == $shipment->id)
                                    <span class="text-[#5E0035] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        En cours d'édition
                                    </span>
                                @else
                                    <!-- Actions buttons -->
                                    <button wire:click="editShipment({{ $shipment->id }})"
                                        wire:loading.attr="disabled" wire:target="editShipment({{ $shipment->id }})"
                                        class="text-[#5E0035] hover:text-blue-900 mr-3 relative">
                                        <svg wire:loading.remove wire:target="editShipment({{ $shipment->id }})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <svg wire:loading wire:target="editShipment({{ $shipment->id }})"
                                            xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="showDeleteModal({{ $shipment->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="showDeleteModal({{ $shipment->id }})"
                                        class="text-red-600 hover:text-red-900 relative">
                                        <svg wire:loading.remove wire:target="showDeleteModal({{ $shipment->id }})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <svg wire:loading wire:target="showDeleteModal({{ $shipment->id }})"
                                            xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Aucune expédition trouvée. Cliquez sur "Ajouter une expédition" pour commencer.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
            {{ $shipments->links() }}
        </div>

        <!-- Ajout du modal de confirmation de suppression -->
        <div x-data="{ show: @entangle('showDeleteConfirmation') }" x-show="show" x-cloak
            class="fixed inset-0 overflow-y-auto z-50 flex items-center justify-center"
            style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="relative bg-white rounded-lg max-w-md w-full mx-auto p-6 shadow-xl"
                @click.away="show = false">
                <div class="mb-4 text-center">
                    <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Confirmation de suppression</h3>
                    <div class="mt-2 text-sm text-gray-500">
                        <p>Êtes-vous sûr de vouloir supprimer cette expédition ? Cette action est irréversible.</p>
                    </div>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="cancelDelete" wire:loading.attr="disabled"
                        wire:loading.class="bg-gray-300 cursor-not-allowed opacity-70"
                        wire:target="cancelDelete, confirmDelete"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-150">
                        <span wire:loading.remove wire:target="cancelDelete">
                            Annuler
                        </span>
                        <span wire:loading wire:target="cancelDelete">
                            Annulation...
                        </span>
                    </button>
                    <button type="button" wire:click="confirmDelete" wire:loading.attr="disabled"
                        wire:loading.class="bg-red-400 cursor-not-allowed opacity-80"
                        wire:target="cancelDelete, confirmDelete"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-150">
                        <span wire:loading.remove wire:target="confirmDelete">
                            Supprimer
                        </span>
                        <span wire:loading wire:target="confirmDelete">
                            Suppression...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
