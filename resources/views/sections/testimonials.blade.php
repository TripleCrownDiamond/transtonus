<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section dark-background">

    <!-- Background Image -->
    <img src="{{ asset('img/testimonials-bg.jpg') }}" class="testimonials-bg" alt="">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Swiper Container -->
        <div class="swiper init-swiper">
            <!-- Swiper Configuration -->
            <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                }
            </script>

            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper">

                <!-- Testimonial Item 1 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial1.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial1.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial1.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 2 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial2.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial2.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial2.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 3 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial3.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial3.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial3.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 4 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial4.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial4.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial4.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 5 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial5.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial5.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial5.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 6 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-6.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial6.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial6.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial6.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 7 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-7.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial7.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial7.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial7.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <!-- Testimonial Item 8 -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{ asset('img/testimonials/testimonials-8.jpg') }}" class="testimonial-img" alt="">
                        <h3>{{ __('messages.testimonials.testimonial8.name') }}</h3>
                        <h4>{{ __('messages.testimonials.testimonial8.position') }}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ __('messages.testimonials.testimonial8.text') }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

            </div>

            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>

    </div>

</section>
<!-- /Testimonials Section -->