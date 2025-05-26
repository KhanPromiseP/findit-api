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

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary-color: #3f51b5;
                --secondary-color: #06a3c3;
                --accent-color: #ff6b6b;
            }
                        .card-background {
                background: linear-gradient(135deg,rgb(66, 88, 212) 0%,rgb(82, 202, 218) 50%,rgb(223, 213, 240) 100%);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
              
            }

            /* Auth Page Styles */
            .auth-background {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                min-height: 100vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                padding-top: 80px; /* Account for fixed navbar */
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
        <!-- Navbar with Tailwind classes -->
        <nav class="fixed w-full z-50 bg-black bg-opacity-85 backdrop-blur-md transition-all duration-300 shadow-md">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-20">
                    <!-- Brand logo -->
                    <a href="/" class="flex items-center">
                        <span class="text-white text-2xl md:text-3xl font-bold">Find</span>
                        <span class="text-[#06a3c3] text-2xl md:text-3xl font-bold">It</span>
                    </a>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" 
                                class="text-white hover:text-gray-300 focus:outline-none"
                                aria-controls="mobile-menu" 
                                aria-expanded="false"
                                onclick="toggleMobileMenu()">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>

                    <!-- Desktop menu -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-purple-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-red-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-black bg-opacity-95 rounded-lg m-2 backdrop-blur-lg">
                    <a href="{{ route('login') }}" class="text-purple-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-red-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                        Sign Up
                    </a>
                </div>
            </div>
        </nav>

        <div class="auth-background">
            <div class="auth-card">
                {{ $slot }}
            </div>

            @stack('scripts')
        </div>

        <script>
            // Toggle mobile menu
            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }

            // Close mobile menu when clicking a link
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('mobile-menu').classList.add('hidden');
                });
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('nav');
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-lg');
                    navbar.classList.add('bg-opacity-95');
                } else {
                    navbar.classList.remove('shadow-lg');
                    navbar.classList.remove('bg-opacity-95');
                }
            });
        </script>
    </body>
</html>