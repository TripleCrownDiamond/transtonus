<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Transtonus') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* Variables de couleur */
        :root {
            --primary-color: #001973;
            --secondary-color: #ed751c;
            --background-color: rgba(237, 117, 28, 0.1); /* Fond transparent */
            --text-color: #212529;
        }

        body {
            font-family: 'Roboto', system-ui, sans-serif;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .email-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 0 auto; /* Centrage horizontal */
        }

        h1, h2 {
            color: var(--primary-color);
            font-family: 'Poppins', sans-serif;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .icon {
            background-color: var(--background-color);
            color: var(--secondary-color);
            padding: 1rem;
            border-radius: 50%;
            width: 80px; /* Taille augmentée */
            height: 80px; /* Taille augmentée */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px;
        }

        .site-info {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: var(--text-color);
        }

        .site-info p {
            margin: 5px 0;
        }

        .btn-visit-site {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s ease; /* Transition pour le hover */
        }

        .btn-visit-site:hover {
            background-color: darken(var(--secondary-color), 10%); /* Changement de couleur au hover */
        }

        .social-icons {
            text-align: center;
            margin-top: 1.5rem;
        }

        .social-icons a {
            margin: 0 10px;
            color: var(--primary-color);
            font-size: 24px;
            transition: color 0.3s ease; /* Transition pour le hover */
        }

        .social-icons a:hover {
            color: var(--secondary-color); /* Changement de couleur au hover */
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Icône contextuelle -->
        <div class="icon-container">
            <div class="icon">
                <!-- Icône SVG d'enveloppe -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 8 8" fill="currentColor">
                    <path d="M0 1v1l4 2 4-2V1H0zm0 2v4h8V3L4 5 0 3z"></path>
                </svg>
            </div>
        </div>

        <!-- Section dynamique pour le contenu -->
        @yield('content')

        <!-- Informations du site -->
        <div class="site-info">
            <p>{{ config('app.name') }}</p>
            <p>{{ env('APP_ADDRESS') }}</p>
            <p>{{ env('APP_CITY') }}, {{ env('APP_COUNTRY') }}</p>
            <p>{{ env('APP_PHONE') }}</p>
            <p>{{ env('APP_EMAIL') }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Transtonus') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>