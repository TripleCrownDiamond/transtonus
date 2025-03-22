<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('img/dark.png') }}" alt="Logo">
            <h1 class="sitename">{{ config('app.name', 'Transtonus') }}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">{{ __('messages.nav.home') }}</a></li>
                <li><a href="#about">{{ __('messages.nav.about') }}</a></li>
                <li><a href="#services">{{ __('messages.nav.services') }}</a></li>
                <li class="dropdown">
                    <a href="#"><span>{{ __('messages.nav.solutions') }}</span> <i class="fas fa-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">{{ __('messages.nav.maritime') }}</a></li>
                        <li><a href="#">{{ __('messages.nav.logistics') }}</a></li>
                        <li><a href="#">{{ __('messages.nav.customs') }}</a></li>
                    </ul>
                </li>
                <li><a href="#contact">{{ __('messages.nav.contact') }}</a></li>
            </ul>
        </nav>

        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="btn btn-link nav-link dropdown-toggle text-decoration-none text-white" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ app()->getLocale() == 'fr' ? 'FR' : 'EN' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li><a class="dropdown-item" href="{{ route('home', ['locale' => 'fr']) }}">FR</a></li>
                    <li><a class="dropdown-item" href="{{ route('home', ['locale' => 'en']) }}">EN</a></li>
                </ul>
            </div>
            <a class="btn-getstarted" href="{{ route('login') }}">
                {{ __('messages.nav.devis') }} <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        
        <i class="mobile-nav-toggle d-xl-none fas fa-bars"></i>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Change header style on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('#header');
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Mobile nav toggle
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    if (mobileNavToggle) {
        mobileNavToggle.addEventListener('click', function() {
            document.body.classList.toggle('mobile-nav-active');
            this.classList.toggle('fa-bars');
            this.classList.toggle('fa-times');
        });
    }
});
</script>