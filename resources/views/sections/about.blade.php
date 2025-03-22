<!-- About Section -->
<section id="about" class="about section">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Image à droite -->
            <div class="col-lg-6 position-relative align-self-center order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
                <div class="about-img-container">
                    <img src={{ asset('img/about-img.webp') }} class="img-fluid" alt="{{ config('app.name', 'Transtonus') }}">
                </div>
            </div>
            
            <!-- Contenu à gauche -->
            <div class="col-lg-6 content order-last order-lg-first" data-aos="fade-up" data-aos-delay="100">
                <h3>{{ __('messages.about.title') }}</h3>
                <p>{{ __('messages.about.description') }}</p>
                <ul>
                    <li>
                        <i class="bi bi-diagram-3"></i>
                        <div>
                            <h5>{{ __('messages.about.feature1_title') }}</h5>
                            <p>{{ __('messages.about.feature1_description') }}</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-fullscreen-exit"></i>
                        <div>
                            <h5>{{ __('messages.about.feature2_title') }}</h5>
                            <p>{{ __('messages.about.feature2_description') }}</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-broadcast"></i>
                        <div>
                            <h5>{{ __('messages.about.feature3_title') }}</h5>
                            <p>{{ __('messages.about.feature3_description') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /About Section -->