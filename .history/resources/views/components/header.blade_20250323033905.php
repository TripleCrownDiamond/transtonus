<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <!-- Logo à gauche -->
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo d-flex align-items-center">
            @if(file_exists(public_path('img/white.png')))
                <img src="{{ asset('img/white.png') }}" alt="Logo" class="logo-img">
            @else
                <h1 class="sitename">{{ config('app.name', 'Transtonus') }}</h1>
            @endif
        </a>

        <!-- Navigation au centre (sur desktop) -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <!-- Accueil -->
                <li>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" 
                       class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        {{ __('messages.nav.home') }}
                    </a>
                </li>
                
                <!-- Services - Page dédiée -->
                <li>
                    <a href="{{ route('services', ['locale' => app()->getLocale()]) }}" 
                       class="{{ request()->routeIs('services') ? 'active' : '' }}">
                        {{ __('messages.nav.services') }}
                    </a>
                </li>
                
                <!-- Contact - Page dédiée -->
                <li>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" 
                       class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        {{ __('messages.nav.contact') }}
                    </a>
                </li>
                
                <!-- Sélecteur de langue -->
                <li class="dropdown">
                    <a href="#"><span>{{ strtoupper(app()->getLocale()) }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @foreach($availableLanguages as $language)
                            <li>
                                <a href="{{ route(Route::currentRouteName(), ['locale' => $language] + Route::current()->parameters()) }}" 
                                   class="{{ app()->getLocale() == $language ? 'active' : '' }}">{{ strtoupper($language) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                
                <!-- Added Devis button in mobile menu -->
                <li class="d-xl-none">
                    <a href="{{ route('quote', ['locale' => app()->getLocale()]) }}" 
                       class="mobile-btn-getstarted {{ request()->routeIs('quote') ? 'disabled' : '' }}">
                        {{ __('messages.nav.quote') }}
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Wrapper pour les éléments à droite -->
        <div class="d-flex align-items-center">
            <!-- Lien vers la page de devis - desktop only -->
            <a class="btn-getstarted d-none d-xl-block {{ request()->routeIs('quote') ? 'disabled' : '' }}" 
               href="{{ request()->routeIs('quote') ? 'javascript:void(0);' : route('quote', ['locale' => app()->getLocale()]) }}">
                {{ __('messages.nav.quote') }}
            </a>
        </div>

        <!-- Burger à droite -->
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </div>
</header>