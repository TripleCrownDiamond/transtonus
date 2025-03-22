<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="block h-12 w-auto" />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien de réinitialisation pour en choisir un nouveau.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Adresse e-mail') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Envoyer le lien de réinitialisation') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
