<!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section dark-background">

    <!-- Image de fond -->
    <img src="{{ asset('img/cta-bg.jpg') }}" alt="{{ __('messages.cta.background_alt') }}">

    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-xl-10">
                <div class="text-center">
                    <h3>{{ __('messages.cta.title') }}</h3>
                    <p>{{ __('messages.cta.description') }}</p>
                    <a class="cta-btn" href="{{ route('quote', ['locale' => app()->getLocale()]) }}">
                        {{ __('messages.cta.button_text') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Call To Action Section -->