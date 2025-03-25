<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo d-flex align-items-center">
                    @if (file_exists(public_path('img/dark.png')))
                        <img src="{{ asset('img/white.png') }}" alt="Logo" class="logo-img">
                    @else
                        <h1 class="sitename">{{ config('app.name', 'Transtonus') }}</h1>
                    @endif
                </a>
                <p>{{ __('messages.footer.company_description') }}</p>
                <div class="social-links d-flex mt-4">
                    <a href="{{ env('APP_SOCIAL_FACEBOOK', '#') }}"><i class="bi bi-facebook"></i></a>
                    <a href="{{ env('APP_SOCIAL_INSTAGRAM', '#') }}"><i class="bi bi-instagram"></i></a>
                    <a href="{{ env('APP_SOCIAL_LINKEDIN', '#') }}"><i class="bi bi-linkedin"></i></a>
                    <a href="{{ env('APP_SOCIAL_TWITTER', '#') }}"><i class="bi bi-twitter"></i></a>

                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>{{ __('messages.footer.useful_links') }}</h4>
                <ul>
                    <li>
                        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            {{ __('messages.nav.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.nav.services') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                            {{ __('messages.nav.contact') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quote', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('quote') ? 'active' : '' }}">
                            {{ __('messages.nav.quote') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('terms') ? 'active' : '' }}">
                            {{ __('messages.footer.terms') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('privacy') ? 'active' : '' }}">
                            {{ __('messages.nav.privacy-policy') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>{{ __('messages.footer.our_services') }}</h4>
                <ul>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.storage_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.logistics_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.cargo_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.trucking_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.packaging_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services', ['locale' => app()->getLocale()]) }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            {{ __('messages.services.warehousing_title') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>{{ __('messages.footer.contact_us') }}</h4>
                <strong>{{ __('messages.contact.address_title') }} :</strong>
                <p>{{ env('APP_ADDRESS') }}</p>
                <p>{{ env('APP_CITY') }}</p>
                <p>{{ env('APP_COUNTRY') }}</p>
                <p class="mt-4"><strong>{{ __('messages.nav.contact') }}:</strong>
                    <span>{{ env('APP_PHONE') }}</span>
                </p>
                <p><strong>Email:</strong> <span>{{ env('APP_EMAIL') }}</span></p>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>&copy; <span>Copyright</span> <strong>{{ config('app.name', 'Transtonus') }}</strong>
            <span>{{ __('messages.footer.copyright') }}</span>
        </p>
    </div>
</footer>
