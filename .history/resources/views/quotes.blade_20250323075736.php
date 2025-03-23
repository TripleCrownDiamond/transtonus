<!-- resources/views/configs.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion d
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Passer les données du fichier .env au composant Livewire -->
                @livewire('manage-languages')
            </div>
        </div>
    </div>
</x-app-layout>
