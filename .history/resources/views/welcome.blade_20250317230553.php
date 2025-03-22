<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Authentique Transport Maritime') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">{{ __('messages.nav.services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">{{ __('messages.nav.contact') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ app()->getLocale() == 'fr' ? 'FR' : 'EN' }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('home', ['locale' => 'fr']) }}">FR</a></li>
                            <li><a class="dropdown-item" href="{{ route('home', ['locale' => 'en']) }}">EN</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-brand ms-2" href="{{ route('login') }}">{{ __('messages.nav.devis') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNav');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('navbar-scrolled');
                    navbar.classList.remove('navbar-transparent');
                } else {
                    navbar.classList.add('navbar-transparent');
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        });
    </script>
</body>

</html>