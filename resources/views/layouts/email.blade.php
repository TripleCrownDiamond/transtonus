<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Transtonus') }}</title>
    <style>
        /* Simple email styles that work well in Gmail */
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h2,
        h3 {
            color: #5E0035;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 15px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
            color: #5E0035;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #5E0035;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00A7E1;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .company-info {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('img/dark.png') }}g" alt="{{ config('app.name') }}" width="180">
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="footer">
            <!-- Company Info -->
            <div class="company-info">
                <p>{{ config('app.name') }}</p>
                <p>{{ env('APP_ADDRESS') }}, {{ env('APP_CITY') }}, {{ env('APP_COUNTRY') }}</p>
                <p>{{ env('APP_PHONE') }} | {{ env('APP_EMAIL') }}</p>
                <p>{{ env('APP_COMPANY_LEGAL_NAME') }} - {{ env('APP_COMPANY_REGISTRATION_NUMBER') }}</p>
                <p>{{ env('APP_COMPANY_TAX_ID') }}</p>
            </div>

            <!-- Social Media Links -->
            <div class="social-links">
                @if (env('APP_SOCIAL_FACEBOOK') && env('APP_SOCIAL_FACEBOOK') != '#')
                    <a href="{{ env('APP_SOCIAL_FACEBOOK') }}">Facebook</a>
                @endif

                @if (env('APP_SOCIAL_TWITTER') && env('APP_SOCIAL_TWITTER') != '#')
                    <a href="{{ env('APP_SOCIAL_TWITTER') }}">Twitter</a>
                @endif

                @if (env('APP_SOCIAL_INSTAGRAM') && env('APP_SOCIAL_INSTAGRAM') != '#')
                    <a href="{{ env('APP_SOCIAL_INSTAGRAM') }}">Instagram</a>
                @endif

                @if (env('APP_SOCIAL_LINKEDIN') && env('APP_SOCIAL_LINKEDIN') != '#')
                    <a href="{{ env('APP_SOCIAL_LINKEDIN') }}">LinkedIn</a>
                @endif
            </div>

            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
