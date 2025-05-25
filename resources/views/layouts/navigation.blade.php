<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIt</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons (kept since Tailwind doesn't include icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
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
    </style>
</head>
<body class="bg-white">
    <nav class="bg-white border-b border-gray-200 py-0">
        <div class="max-w-[1200px] mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center w-full h-16">
                <!-- Left side: Brand -->
                <div class="flex items-center">
                    <div class="hidden sm:flex items-center sm:ml-3 lg:ml-10">
                        <a class="navbar-brand" href="{{ route('dashboard') }}">
                            <span class="font-bold text-2xl gradient-text">FindIt</span>
                        </a>
                    </div>
                </div>

                   

                <!-- Right side: Profile dropdown -->
                <div class="hidden sm:flex items-center sm:ml-6">
                 <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('about.show') }}">
                    About Us
                    </a>
                    <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('contact.show') }}">
                        Contact us
                    </a>
                    <div class="relative">
                    @if(Auth::check())
                        <button class="p-1 flex items-center border-0 rounded-full" type="button" id="profileDropdown">
                            <img src="{{ asset('storage/' . Auth::user()->profile_path) ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=4F46E5&color=fff' }}" 
                            
                                 alt="{{ Auth::user()->name }}" class="rounded-full profile-img">
                            <i class="bi bi-chevron-down ml-2 text-gray-500"></i>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 py-1 bg-gray-50 rounded-md shadow-lg border-0 z-50">
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('dashboard') }}">Home Dashboard</a>
                             @if(Auth::check() && Auth::user()->is_admin)
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            @endif

                           
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">Profile</a>
                           
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('posts.mine') }}">My Posts</a>
                            <div class="border-t border-gray-200 mx-4 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 logout-btn">Log Out</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="flex sm:hidden items-center -mr-2">
                    <div class="font-bold text-lg gradient-text fixed left-0 pl-4 top-3">
                        FindIt
                    </div>
                    <button class="p-2 rounded-md" type="button" id="mobileMenuButton">
                        <i class="bi bi-list text-gray-400 text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu - sliding from left side -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
        <div class="mobile-menu fixed top-0 left-0 h-full bg-white shadow-lg z-50" id="mobileMenu">
            <div class="h-full flex flex-col">
                <!-- Header with app name and close button -->
                <div class="flex justify-between items-center p-4 border-b">
                    <div class="font-bold text-lg gradient-text">FindIt</div>
                    <button class="p-1" id="closeMobileMenu">
                        <i class="bi bi-x-lg text-gray-500 text-xl"></i>
                    </button>
                </div>
                
                <!-- Menu content with scrollable area -->
                <div class="flex-grow overflow-y-auto">
                    <div class="px-3 pt-2">
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 mr-3"></i> Home Dashboard
                        </a>
                        @if(Auth::check() && Auth::user()->is_admin)
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-shield-lock mr-3"></i> Admin Dashboard
                        </a>
                        @endif
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('about.show') }}">
                            <i class="bi bi-info-circle mr-3"></i> About Us
                        </a>
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('contact.show') }}">
                            <i class="bi bi-envelope mr-3"></i> Contact Us
                        </a>
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person mr-3"></i> Profile
                        </a>
                        <a class="nav-link-item block py-3 px-3 rounded" href="{{ route('posts.mine') }}">
                            <i class="bi bi-file-post mr-3"></i> My Posts
                        </a>
                    </div>
                </div>

                <!-- User info and logout at bottom -->
                @if(Auth::check())
                <div class="border-t p-4 bg-gray-50">
                    <div class="mb-3">
                        <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center border border-red-500 text-red-500 hover:bg-red-50 py-2 px-4 rounded">
                            <i class="bi bi-box-arrow-right mr-2"></i> Log Out
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Desktop dropdown toggle
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            profileDropdown.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdown.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            function showMobileMenu() {
                document.body.style.overflow = 'hidden';
                mobileMenu.classList.add('show');
                mobileOverlay.classList.add('show');
            }
            
            function hideMobileMenu() {
                document.body.style.overflow = '';
                mobileMenu.classList.remove('show');
                mobileOverlay.classList.remove('show');
            }
            
            mobileMenuButton.addEventListener('click', showMobileMenu);
            closeMobileMenu.addEventListener('click', hideMobileMenu);
            mobileOverlay.addEventListener('click', hideMobileMenu);
            
            // Close menu when clicking on links
            document.querySelectorAll('#mobileMenu .nav-link-item').forEach(link => {
                link.addEventListener('click', hideMobileMenu);
            });
            
            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideMobileMenu();
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>