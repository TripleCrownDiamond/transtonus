<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <!-- Image de fond -->
    <img src="{{ asset('img/worldmap.webp') }}" alt="Hero Bg" class="hero-bg" data-aos="fade-in">

    <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
            <!-- Contenu à gauche -->
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2 data-aos="fade-up">{{ __('messages.hero.title') }}</h2>
                <p data-aos="fade-up" data-aos-delay="100">
                    {{ __('messages.hero.subtitle') }}
                </p>

                <!-- Formulaire de recherche -->
                <form action="{{ route('shipment.search') }}" method="POST" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                    @csrf
                    <input type="text" name="tracking_number" class="form-control" placeholder="{{ __('messages.hero.track_input') }}" required>
                    <button type="submit" class="btn btn-primary">{{ __('messages.hero.track_button') }}</button>
                </form>

                <!-- Statistiques -->
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="0" class="purecounter">232</span>
                            <p>{{ __('messages.stats.clients') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="0" class="purecounter">521</span>
                            <p>{{ __('messages.stats.parcel') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="0" class="purecounter">1453</span>
                            <p>{{ __('messages.stats.countries') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="0" class="purecounter">32</span>
                            <p>{{ __('messages.stats.addresses') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image à droite -->
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{ asset('img/hero-img.png') }}" class="img-fluid mb-3 mb-lg-0" alt="">
            </div>
        </div>
    </div>
    <!-- Add this before the closing body tag -->
@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Erreur!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'var(--primary-color)'
        });
    });
</script>
@endif

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Succès!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: 'var(--primary-color)'
        });
    });
</script>
@endif
</section>
<!-- /Hero Section -->