document.addEventListener("DOMContentLoaded", function () {
    // Mobile nav toggle
    const mobileNavToggle = document.querySelector(".mobile-nav-toggle");
    const navmenu = document.querySelector(".navmenu");

    if (mobileNavToggle) {
        mobileNavToggle.addEventListener("click", function (e) {
            document.body.classList.toggle("mobile-nav-active");
            this.classList.toggle("fa-bars");
            this.classList.toggle("fa-times");
        });
    }

    // Toggle dropdowns
    const dropdownToggles = document.querySelectorAll(".toggle-dropdown");
    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            const parentLi = this.closest("li.dropdown");
            const dropdownList = parentLi.querySelector("ul");
            dropdownList.classList.toggle("dropdown-active");
            this.classList.toggle("active");
        });
    });

    // Change header style on scroll
    window.addEventListener("scroll", function () {
        const header = document.querySelector("#header");
        if (window.scrollY > 100) {
            document.body.classList.add("scrolled");
        } else {
            document.body.classList.remove("scrolled");
        }
    });
});
