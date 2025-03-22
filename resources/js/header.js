/**
 * Navigation and Mobile Menu functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    // Get all elements needed
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navmenu = document.querySelector('.navmenu');
    const dropdownToggles = document.querySelectorAll('.dropdown-indicator');
    const body = document.querySelector('body');
    
    // Make sure Bootstrap icons are loaded
    // You may need to include Bootstrap icons in your project
    if (!document.querySelector('link[href*="bootstrap-icons"]')) {
      const iconLink = document.createElement('link');
      iconLink.rel = 'stylesheet';
      iconLink.href = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css';
      document.head.appendChild(iconLink);
    }
    
    // Toggle mobile nav
    if (mobileNavToggle) {
      mobileNavToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        body.classList.toggle('mobile-nav-active');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
        
        // Debug logging
        console.log('Mobile nav toggled:', body.classList.contains('mobile-nav-active'));
      });
    } else {
      console.error('Mobile nav toggle button not found!');
    }
    
    // Handle dropdown toggles for mobile view
    if (dropdownToggles.length > 0) {
      dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
          if (window.innerWidth < 1200) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdownElement = this.closest('.dropdown');
            const dropdownList = dropdownElement.querySelector('ul');
            
            dropdownElement.classList.toggle('dropdown-active');
            if (dropdownList) {
              dropdownList.classList.toggle('dropdown-active');
            }
            
            // Toggle dropdown indicator icon
            this.classList.toggle('bi-chevron-down');
            this.classList.toggle('bi-chevron-up');
          }
        });
      });
    } else {
      console.warn('No dropdown toggles found');
    }
    
    // Close mobile nav when clicking outside
    document.addEventListener('click', function(e) {
      if (body.classList.contains('mobile-nav-active') && 
          !e.target.closest('.navmenu') && 
          !e.target.closest('.mobile-nav-toggle')) {
        body.classList.remove('mobile-nav-active');
        const toggle = document.querySelector('.mobile-nav-toggle');
        if (toggle) {
          toggle.classList.remove('bi-x');
          toggle.classList.add('bi-list');
        }
      }
    });
    
    // Handle fixed header on scroll
    const selectHeader = document.querySelector('#header');
    if (selectHeader) {
      let headerOffset = selectHeader.offsetTop;
      let nextElement = selectHeader.nextElementSibling;
      
      const headerFixed = () => {
        if ((headerOffset - window.scrollY) <= 0) {
          document.body.classList.add('scrolled');
          if (nextElement) nextElement.classList.add('scrolled-offset');
        } else {
          document.body.classList.remove('scrolled');
          if (nextElement) nextElement.classList.remove('scrolled-offset');
        }
      };
      
      window.addEventListener('load', headerFixed);
      window.addEventListener('scroll', headerFixed);
    }
    
    // Reset mobile menu when resizing to desktop
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 1200) {
        if (body.classList.contains('mobile-nav-active')) {
          body.classList.remove('mobile-nav-active');
          const toggle = document.querySelector('.mobile-nav-toggle');
          if (toggle) {
            toggle.classList.remove('bi-x');
            toggle.classList.add('bi-list');
          }
        }
        
        // Reset all dropdowns
        document.querySelectorAll('.dropdown-active').forEach(dropdown => {
          dropdown.classList.remove('dropdown-active');
        });
        
        // Reset dropdown indicators
        document.querySelectorAll('.dropdown-indicator.bi-chevron-up').forEach(indicator => {
          indicator.classList.remove('bi-chevron-up');
          indicator.classList.add('bi-chevron-down');
        });
      }
    });
    
    // Log any issues for debugging
    console.log('Navigation script loaded successfully');
    console.log('Mobile toggle found:', !!mobileNavToggle);
    console.log('Navmenu found:', !!navmenu);
    console.log('Dropdown toggles found:', dropdownToggles.length);
  });