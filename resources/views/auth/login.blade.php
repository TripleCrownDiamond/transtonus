<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="block h-12 w-auto" />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

             <!-- Admin Login Title -->
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion Admin</h2>

            <div>
                <x-label for="email" value="Adresse e-mail" class="text-gray-700 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <x-input id="email" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                        placeholder="votre@email.com" />
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="Mot de passe" class="text-gray-700 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-input id="password" class="block mt-1 w-full pl-10 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" 
                        type="password" name="password" required autocomplete="current-password" 
                        placeholder="••••••••" />
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <!-- Direct HTML button instead of component -->
                <button type="submit" 
                    class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-75 disabled:bg-blue-400"
                    x-data=""
                    x-on:click="$el.disabled = true; $el.classList.add('bg-blue-400');"
                    x-on:submit="$el.disabled = true; $el.classList.add('bg-blue-400');">
                    <span x-data="{ loading: false }" x-on:click="loading = true" x-show="!loading">Se connecter</span>
                    <span x-data="{ loading: false }" x-on:click="loading = true" x-show="loading" style="display: none;">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Connexion...
                    </span>
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
