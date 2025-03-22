<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Authentique Transport Maritime') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="landing-page">
    @include('components.navigation')

    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Votre partenaire de confiance en transport maritime</h1>
                    <p>Solutions logistiques sur mesure pour vos besoins d'expédition internationaux</p>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Change header style on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('#header');
                if (window.scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Mobile nav toggle
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function() {
                    document.body.classList.toggle('mobile-nav-active');
                    this.classList.toggle('fa-bars');
                    this.classList.toggle('fa-times');
                });
            }
        });
    </script>
</body>

</html>