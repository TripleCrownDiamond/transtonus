@php
    $devisLink = route('quote', ['locale' => app()->getLocale()]);
@endphp

<!-- Featured Services Section -->
<section id="featured-services" class="featured-services section">
    <div class="container">
        <div class="row gy-4">
            <!-- Gage de Confiance 1 -->
            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="icon flex-shrink-0">
                    <div class="icon-container">
                        <i class="fas fa-shield-alt"></i> <!-- Icône de bouclier -->
                    </div>
                </div>
                <div>
                    <h4 class="title">{{ __('messages.featured.quality_title') }}</h4>
                    <p class="description">{{ __('messages.featured.quality_description') }}</p>
                    <a href="{{ $devisLink }}" class="readmore stretched-link">
                        <span>{{ __('messages.featured.request_quote') }}</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- End Gage de Confiance 1 -->

            <!-- Gage de Confiance 2 -->
            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="icon flex-shrink-0">
                    <div class="icon-container">
                        <i class="fas fa-stopwatch"></i> <!-- Icône de chronomètre -->
                    </div>
                </div>
                <div>
                    <h4 class="title">{{ __('messages.featured.punctuality_title') }}</h4>
                    <p class="description">{{ __('messages.featured.punctuality_description') }}</p>
                    <a href="{{ $devisLink }}" class="readmore stretched-link">
                        <span>{{ __('messages.featured.request_quote') }}</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- End Gage de Confiance 2 -->

            <!-- Gage de Confiance 3 -->
            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="icon flex-shrink-0">
                    <div class="icon-container">
                        <i class="fas fa-headset"></i> <!-- Icône de support -->
                    </div>
                </div>
                <div>
                    <h4 class="title">{{ __('messages.featured.support_title') }}</h4>
                    <p class="description">{{ __('messages.featured.support_description') }}</p>
                    <a href="{{ $devisLink }}" class="readmore stretched-link">
                        <span>{{ __('messages.featured.request_quote') }}</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- End Gage de Confiance 3 -->
        </div>
    </div>
</section>
<!-- /Featured Services Section -->