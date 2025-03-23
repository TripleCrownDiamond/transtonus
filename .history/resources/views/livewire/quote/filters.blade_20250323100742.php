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
