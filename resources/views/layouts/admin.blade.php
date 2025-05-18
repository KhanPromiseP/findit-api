<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - FindIt</title>


    <link rel="icon" type="image/png" href="{{ asset('logo/findit-logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuQlLWg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sidebar-full-height {
            height: 100vh; 
            position: fixed; 
            top: 0;
            left: 0; 
            z-index: 20; 
        }

        .main-content-with-sidebar {
            margin-left: 16rem; 
            flex-grow: 1;
        }

        @media (max-width: 767px) {
            .main-content-with-sidebar {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        <aside class="sidebar-full-height bg-gradient-to-b from-indigo-600 to-indigo-800 text-white w-64 py-8 px-4 flex flex-col shadow-md transform -translate-x-64 md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <div class="logo text-2xl font-semibold mb-8 text-center">
                <i class="fa-solid fa-magnifying-glass text-yellow-400 mr-2"></i> Admin FindIt
            </div>
            <nav class="flex-1 overflow-y-auto mb-8">
                <ul class="list-none p-0">
                    <li class="mb-3">
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-solid fa-chart-line fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </li>
                     <li class="mb-3">
                        <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-regular fa-clock fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">All Lost Items</span>
                        </a>
                    </li>
                     <li class="mb-3">
                        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.index') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-regular fa-clock fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Create Categories</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.pending-posts') }}" class="{{ request()->routeIs('admin.pending-posts') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-regular fa-clock fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Pending</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.approved-posts') }}" class="{{ request()->routeIs('admin.approved-posts') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-solid fa-check-double fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Approved</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'bg-indigo-900 shadow-md' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="fa-solid fa-users fa-sm mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Users</span>
                        </a>
                    </li>
                   
                </ul>
            </nav>
            <div class="p-4 bg-indigo-800 rounded-md shadow-md">
                <h6 class="text-sm font-semibold text-gray-300 mb-2">Account</h6>
                <a href="{{ route('profile.edit') }}" class="flex items-center text-sm text-gray-200 hover:text-white transition duration-300">
                    <i class="fa-solid fa-user fa-sm mr-3 text-yellow-400"></i>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="flex items-center text-sm text-gray-200 hover:text-white transition duration-300">
                        <i class="fa-solid fa-sign-out-alt fa-sm mr-3 text-yellow-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col overflow-y-auto main-content-with-sidebar">
            <nav class="bg-white shadow-sm sticky top-0 z-10">
                <div class="px-4 py-3 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center">
                        <button id="sidebar-toggle" class="text-gray-500 focus:outline-none mr-4">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-indigo-700 font-semibold text-lg">
                            <i class="fa-solid fa-chart-line fa-sm mr-2"></i>
                            Dashboard
                        </a>
                    </div>
                    <div>
                        </div>
                </div>
            </nav>

            <main class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $header ?? 'Admin Area' }}</h2>
                <div class="bg-white shadow-md rounded-md p-6">
                    {{ $slot }}
                </div>
            </main>
               <!-- @include('partials._footer') -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mainContent = document.querySelector('.main-content-with-sidebar');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('-translate-x-64');
                });
            }

            // Adjust main content margin on larger screens
            if (window.innerWidth >= 768) {
                mainContent.classList.add('ml-64');
            }
        });
    </script>
</body>
</html>