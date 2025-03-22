document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne tous les Swipers avec la classe .init-swiper
    document.querySelectorAll('.init-swiper').forEach((swiperEl) => {
      // Récupère la configuration JSON
      const config = JSON.parse(swiperEl.querySelector('.swiper-config').textContent);
  
      // Initialise Swiper
      new Swiper(swiperEl, {
        loop: config.loop,
        speed: config.speed,
        autoplay: config.autoplay,
        slidesPerView: config.slidesPerView,
        pagination: {
          el: config.pagination.el,
          type: config.pagination.type,
          clickable: config.pagination.clickable,
        },
      });
    });
  });