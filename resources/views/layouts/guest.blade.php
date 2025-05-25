<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('logo/findit-logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .auth-background {
                background: linear-gradient(135deg,rgb(48, 62, 143) 0%,rgb(132, 130, 168) 50%,rgb(161, 145, 187) 100%);
                min-height: 100vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
            }

            .card-background {
                background: linear-gradient(135deg,rgb(155, 166, 228) 0%,rgb(186, 184, 219) 50%,rgb(223, 213, 240) 100%);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
            }
            .auth-card {
                width: 100%;
                max-width: 28rem;
                background: white;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                margin-top: 1.5rem;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
    
        <div class="auth-background">
          

            <div class="auth-card">
                {{ $slot }}
            </div>

            @stack('scripts')
        </div>
    </body>
</html>