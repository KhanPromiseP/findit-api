<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - FindIt</title>

    <link rel="icon" type="image/png" href="{{ asset('logo/findit-logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

        .gradient-text {
            background-image: linear-gradient(to right, rgb(36, 49, 112), rgb(122, 217, 236));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border: 2px solid #4F46E5;
        }

        .mobile-menu {
            width: 300px;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }

        .mobile-menu.show {
            transform: translateX(0);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .mobile-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .nav-link-item {
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-link-item:hover,
        .nav-link-item:focus {
            color: #111827;
            background-color: #f3f4f6;
        }

        .logout-btn {
            color: #dc3545 !important;
        }

        .logout-btn:hover {
            color: #bb2d3b !important;
        }

        .sidebar-link-active {
            background-color: rgba(49, 46, 129, 0.9);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        <aside class="sidebar-full-height bg-gradient-to-b from-indigo-600 to-indigo-800 text-white w-64 py-8 px-4 flex flex-col shadow-md transform -translate-x-64 md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <div class="logo text-2xl font-semibold mb-8 text-center">
                <i class="bi bi-search text-yellow-400 mr-2"></i> Admin FindIt
            </div>

            <nav class="flex-1 overflow-y-auto mb-8">
                <ul class="list-none p-0">
                    <li class="mb-3">
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-speedometer2 mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Home Dashboard</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('posts.index') }}"
                           class="{{ request()->routeIs('posts.index') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-clock-history mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">All Lost Items</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.categories.index') }}"
                           class="{{ request()->routeIs('admin.categories.*') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-tags mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Categories</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.pending-posts') }}"
                           class="{{ request()->routeIs('admin.pending-posts') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-hourglass-split mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Pending Posts</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.approved-posts') }}"
                           class="{{ request()->routeIs('admin.approved-posts') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-check-circle mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Approved Posts</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.help-requests.index') }}"
                           class="{{ request()->routeIs('admin.help-requests') || request()->routeIs('admin.help-requests.*') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-question-circle mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Help Requests</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.found-items') }}"
                           class="{{ request()->routeIs('admin.found-items') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-check-square mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Found Items</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.payments') }}"
                           class="{{ request()->routeIs('admin.payments') || request()->routeIs('admin.payments.*') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-cash-stack mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Payment Records</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.payment.settings') }}"
                           class="{{ request()->routeIs('admin.payment.settings') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-gear mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Payment Settings</span>
                        </a>
                    </li>

                    <li class="mb-3">
                        <a href="{{ route('admin.users') }}"
                           class="{{ request()->routeIs('admin.users') ? 'sidebar-link-active' : 'hover:bg-indigo-700' }} flex items-center py-2 px-4 rounded-md transition duration-300">
                            <i class="bi bi-people mr-3 text-yellow-400"></i>
                            <span class="text-sm font-medium">Users</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 bg-indigo-800 rounded-md shadow-md">
                <h6 class="text-sm font-semibold text-gray-300 mb-2">My Account</h6>
                <a href="{{ route('profile.edit') }}"
                   class="{{ request()->routeIs('profile.edit') ? 'text-white' : 'text-gray-200' }} flex items-center text-sm hover:text-white transition duration-300 mb-2">
                    <i class="bi bi-person mr-3 text-yellow-400"></i>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center text-sm text-gray-200 hover:text-white transition duration-300 w-full">
                        <i class="bi bi-box-arrow-right mr-3 text-red-600 hover:bg-red-50"></i> 
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col overflow-y-auto main-content-with-sidebar">
            <nav class="bg-white shadow-sm sticky top-0 z-10">
                <div class="px-4 py-3 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center">
                        <button id="sidebar-toggle" class="text-gray-500 focus:outline-none mr-4 md:hidden">
                            
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex items-center text-indigo-700 font-semibold text-lg">
                            
                            <span>Home Dashboard</span>
                        </a>
                    </div>

                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button class="p-1 flex items-center border-0 rounded-full" type="button" id="profileDropdown" @click="open = !open">
                            <img src="{{ Auth::user()->profile_path ? asset('storage/' . Auth::user()->profile_path) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=4F46E5&color=fff' }}"
                                 alt="{{ Auth::user()->name }}" class="rounded-full profile-img">
                            <i class="bi bi-chevron-down ml-2 text-gray-500" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 py-1 bg-white rounded-md shadow-lg border border-gray-200 z-50 origin-top-right">
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('dashboard') }}">
                                 Home Dashboard
                            </a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">
                               Profile
                            </a>
                            @if(Auth::check() && Auth::user()->is_admin)
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('admin.dashboard') }}">
                                Admin Dashboard
                            </a>
                            @endif
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('posts.mine') }}">
                                My Posts
                            </a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $header ?? 'Admin Area' }}</h2>
                <div class="bg-white shadow-md rounded-md p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-64');
                });
            }
        });
    </script>
</body>
</html>