<!-- resources/views/components/contact-section.blade.php -->
<section id="contact" class="contact section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-4">
                <!-- Info Item: Adresse -->
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-container">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div>
                        <h3>{{ __('messages.contact.address_title') }}</h3>
                        <p>{{ env('APP_ADDRESS') }}</p>
                    </div>
                </div><!-- End Info Item -->

                <!-- Info Item: Téléphone -->
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon-container">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div>
                        <h3>{{ __('messages.contact.phone_title') }}</h3>
                        <p>{{ env('APP_PHONE') }}</p>
                    </div>
                </div><!-- End Info Item -->

                <!-- Info Item: Email -->
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon-container">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <h3>{{ __('messages.contact.email_title') }}</h3>
                        <p>{{ env('APP_EMAIL') }}</p>
                    </div>
                </div><!-- End Info Item -->
            </div>

            <div class="col-lg-8">
                @if (Request::is('*/contact'))
                    <!-- Formulaire de contact -->
                    @livewire('contact-form')
                @elseif(Request::is('*/quote'))
                    <!-- Formulaire de devis -->
                    @livewire('quote-form')
                @endif
            </div><!-- End Form -->
        </div>
    </div>
</section><!-- /Contact Section -->