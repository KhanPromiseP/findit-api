<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-2.5 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                <span class="font-extrabold text-2xl"
                                      style="background-image: linear-gradient(to right, rgb(36, 49, 112), rgb(122, 217, 236));
                                             -webkit-background-clip: text;
                                             -webkit-text-fill-color: transparent;">
                                    FindIt
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center sm:hidden ms-4">
                        <div class="relative">
                            <button id="dropdown-trigger-mobile" class="text-black inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                @auth
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endauth
                            </button>

                            <div id="dropdown-content-mobile" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0 bg-white ring-1 ring-black ring-opacity-5 hidden">
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Profile') }}</a>

                                    @if(Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Admin Dashboard') }}</a>
                                    @endif
                                    <a href="{{ route('posts.mine') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('My Posts') }}</a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-start text-gray-800 hover:bg-gray-100">{{ __('Log Out') }}</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Log in') }}</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Register') }}</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="relative" id="custom-dropdown">
                            <span class="font-extrabold text-xl hidden sm:inline"
                                  style="background-image: linear-gradient(to right, rgb(148, 213, 243), rgb(25, 154, 194));
                                         -webkit-background-clip: text;
                                         -webkit-text-fill-color: transparent;">welcome</span>
                            <button id="dropdown-trigger" class="text-black inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                @auth
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endauth
                            </button>

                            <div id="dropdown-content" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0 bg-white ring-1 ring-black ring-opacity-5 hidden">
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Profile') }}</a>

                                    @if(Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Admin Dashboard') }}</a>
                                    @endif
                                    <a href="{{ route('posts.mine') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('My Posts') }}</a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-start text-gray-800 hover:bg-gray-100">{{ __('Log Out') }}</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Log in') }}</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ __('Register') }}</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('dashboard') }}" class="block ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </a>
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                {{ __('Admin') }}
                            </a>
                        @endif
                    @endauth
                </div>

                @auth
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                {{ __('Profile') }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                {{ __('Log in') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endauth
            </div>
        </nav>

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownTrigger = document.getElementById('dropdown-trigger');
            const dropdownContent = document.getElementById('dropdown-content');
            const dropdownTriggerMobile = document.getElementById('dropdown-trigger-mobile');
            const dropdownContentMobile = document.getElementById('dropdown-content-mobile');

            if (dropdownTrigger && dropdownContent) {
                dropdownTrigger.addEventListener('click', function() {
                    dropdownContent.classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    const isClickInside = dropdownTrigger.contains(event.target) || dropdownContent.contains(event.target);
                    if (!isClickInside) {
                        dropdownContent.classList.add('hidden');
                    }
                });
            }

            if (dropdownTriggerMobile && dropdownContentMobile) {
                dropdownTriggerMobile.addEventListener('click', function() {
                    dropdownContentMobile.classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    const isClickInsideMobile = dropdownTriggerMobile.contains(event.target) || dropdownContentMobile.contains(event.target);
                    if (!isClickInsideMobile) {
                        dropdownContentMobile.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>