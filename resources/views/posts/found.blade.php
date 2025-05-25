<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center bg-blue-200 text-blue-600 hover:bg-blue-300 hover:text-blue-800 px-4 py-2 rounded-md transition">
                    Back to Dashboard
                </a>
            </div>

            {{-- Thrilling Banner Message for the Owner --}}
            @auth
                {{-- @if($post->user_id === Auth::id() && $post->status === 'found') --}}
                    <div class="bg-gradient-to-r from-teal-500 to-green-600 p-8 rounded-2xl shadow-xl text-white text-center mb-10 transform -rotate-1 scale-105 transition-all duration-300 ease-in-out hover:rotate-0 hover:scale-100">
                        <h1 class="text-4xl sm:text-5xl font-extrabold mb-4 animate-pulse">
                            Eureka! Your Lost Item Found!
                        </h1>
                        <p class="text-xl sm:text-2xl leading-relaxed font-medium">
                            This is it, <strong class="uppercase">{{ Auth::user()->name }}</strong>! The moment you've been waiting for.
                            Your {{ $post->name ?? 'lost item'}} has been located!
                        </p>
                        <p class="text-lg sm:text-xl mt-4 italic opacity-90">
                            "Every lost item has a story, and yours is about to get its happy ending."
                        </p>
                    </div>
                {{-- @endif --}}
            @endauth

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                @if($post->LostItemImages->count() > 0)
                    <div class="relative h-64 sm:h-80 md:h-96 bg-gray-100 overflow-hidden group">
                        <div class="relative h-full w-full">
                            @foreach($post->LostItemImages as $index => $image)
                                <img src="{{ asset('storage/'.$image->image_path) }}"
                                    alt="{{ $post->name }}"
                                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                                    data-carousel-image="{{ $index }}"
                                    onclick="openFullscreen('{{ asset('storage/'.$image->image_path) }}')">
                            @endforeach
                        </div>

                        @if($post->LostItemImages->count() > 1)
                            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                                @foreach($post->LostItemImages as $index => $image)
                                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-60 hover:bg-opacity-100 transition"
                                            onclick="showImage({{ $index }})"
                                            aria-label="Go to image {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        @if($post->LostItemImages->count() > 1)
                            <button class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 transition opacity-0 group-hover:opacity-100"
                                    onclick="prevImage()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 transition opacity-0 group-hover:opacity-100"
                                    onclick="nextImage()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="h-64 sm:h-80 md:h-96 bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                <div id="fullscreen-viewer" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
                    <button class="absolute top-4 right-4 text-white text-3xl" onclick="closeFullscreen()">&times;</button>
                    <img id="fullscreen-image" class="max-w-full max-h-full object-contain" src="" alt="">

                    @if($post->LostItemImages->count() > 1)
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl" onclick="fullscreenPrevImage()">❮</button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl" onclick="fullscreenNextImage()">❯</button>
                    @endif
                </div>


                <div class="p-6 sm:p-8">
                   <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-800">{{ $post->name }}</h2>
                        <div class="flex flex-col items-end">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($post->is_approved)
                                    bg-yellow-100 text-yellow-800
                                @else
                                    {{ $post->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}
                                @endif">
                                @if($post->is_approved)
                                    Pending Approval
                                @else
                                    {{ ucfirst($post->status) }} (Approved)
                                @endif
                            </span>

                            {{-- @if($post->is_approved && $post->approved_at) --}}
                                <span class="text-xs text-gray-500 mt-1">
                                    Approved on: {{ '15 may 2025'}}
                                </span>
                            {{-- @endif --}}
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $post->location }}
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                            {{-- {{ $post->category->name }} --}}
                        </div>

                        {{-- The "Posted by" and "Contact" details now handle the 'found' scenario below --}}
                        {{-- Keep this only if it's the general poster, not the specific finder --}}
                        {{-- @if(!($post->user_id === Auth::id() && $post->status === 'found')) --}}
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Posted by {{ $post->user->name ?? 'unknown'}}
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $post->contact }}
                            </div>
                        {{-- @endif --}}
                    </div>

                    {{-- @if($post->color) --}}
                    <div class="mb-6">
                        <span class="text-sm font-medium text-gray-700">Color:</span>
                        <span class="ml-2 px-3 py-1 rounded-full text-sm"
                              style="background-color: {{ $post->color }}; color: white; text-shadow: 0 0 2px rgba(0,0,0,0.5)">
                            {{ $post->color }}
                        </span>
                    </div>
                    {{-- @endif --}}

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $post->description }}</p>
                    </div>

                     <a 
                                href="{{ route('testbutton') }}" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-150"
                            >
                                Chat the Poster
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                    {{-- Section for the person who posted the item or the finder --}}
                    @auth
                        {{-- @if($post->user_id === Auth::id() && $post->status === 'found') --}}
                            {{-- PERSONALIZED CONTACT SECTION FOR THE OWNER OF THE LOST AND FOUND ITEM --}}
                            <div class="bg-gradient-to-br from-indigo-50 to-blue-100 p-6 rounded-lg shadow-inner border border-indigo-200 mt-6 mb-8">
                                <h3 class="text-xl font-bold text-indigo-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 0A9 9 0 0112 21l-5.657-5.657m0 0A9 9 0 013 12h-2m18 0h-2M5.636 18.364l3.536-3.536m0 0A9 9 0 0121 12l-5.657 5.657m0 0A9 9 0 0112 3v-2m0 18v-2" />
                                    </svg>
                                    Your Item's Journey: Found by an Amazing Individual!
                                </h3>
                                <p class="text-indigo-700 text-base leading-relaxed mb-4">
                                    <strong>Congratulations, {{ Auth::user()->name }}!</strong> This is the moment you've been searching for.
                                    The {{ $post->name ?? 'item'}} you lost has been found by <strong class="text-indigo-900">{{ $post->user->name?? 'A humble Findit user' }}</strong>,
                                    who has graciously reported it to help you get it back.
                                    You're now just a few steps away from being reunited!
                                </p>
                                <h4 class="text-lg font-semibold text-indigo-800 mb-3">
                                    Contact Details of the Finder:
                                </h4>
                                <ul class="text-indigo-700 text-base space-y-2">
                                    {{-- @if($post->user->email) --}}
                                    <li>
                                        <strong class="text-indigo-900">Email:</strong>
                                        <span class="ml-1">{{ $post->user->email ?? 'user@gmail.com'}}</span>
                                    </li>
                                    {{-- @endif
                                    @if($post->user->contact) --}}
                                    <li>
                                        <strong class="text-indigo-900">Phone:</strong>
                                        <span class="ml-1">{{ $post->user->contact ?? '6798476847'}}</span>
                                    </li>
                                    {{-- @endif --}}
                                    <li>
                                        <strong class="text-indigo-900">Finder's Profile:</strong>
                                        <span class="ml-1">Joined FindIt on {{ '11 may 2025'}}</span>
                                    </li>
                                </ul>

                                {{-- Contact Button --}}
                                <div class="text-center mt-6">
                                    {{-- <a href="{{ $post->user->email ? 'mailto:' . $post->user->email . '?subject=' . urlencode('Regarding My Lost Item: ' . $post->name . ' on FindIt') : ($post->user->contact ? 'tel:' . $post->user->contact : '#') }}"
                                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-700 text-white font-extrabold text-xl rounded-full shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 animate-bounce-once
                                       {{ (!($post->user->email || $post->user->contact)) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                       {{ (!($post->user->email || $post->user->contact)) ? 'onclick="return false;"' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.9 5.27a2 2 0 002.2 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Contact {{ $post->user->name ?? 'unknown'}} & Get Your Item Back!
                                    </a> --}}

                                    {{-- @if(!($post->user->email?? 'user@gmail.com' || $post->user->contact?? '6798476847')) --}}
                                    <p class="mt-4 text-red-700 text-sm">
                                        Uh oh! Direct contact details for {{ $post->user->name ?? 'A humble Findit user'}} are not available.
                                        Please contact FindIt support for assistance in connecting.
                                        <a href="{{ route('contact.show') }}" class="text-blue-600 hover:underline ml-1">Contact Support</a>
                                    </p>
                                    {{-- @endif --}}

                                    <p class="mt-6 text-sm text-gray-500">
                                        <strong>Remember:</strong> Always arrange to meet in a safe, public place after contacting any of our user! Findit cares.
                                    </p>
                                </div>
                            </div>
                        {{-- @else --}}
                            {{-- Original "Posted by" and "Contact" for other users or lost items not yet found --}}
                            {{-- <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md mb-6">
                                <h3 class="text-xl font-semibold text-blue-800 mb-2">About the Poster</h3>
                                <p class="text-blue-700 text-base">
                                    This item was posted by: <strong class="text-blue-900">{{ $post->user->name ?? 'A humble Findit user'}}</strong>.
                                    They are the one who either lost this item or found it.
                                </p>
                                @if($post->user->email?? 'user@gmail.com')
                                <p class="text-blue-700 text-sm mt-1">Email: {{ $post->user->email?? 'user@gmail.com' }}</p>
                                @endif
                                @if($post->user->contact ?? 'unknown')
                                <p class="text-blue-700 text-sm mt-1">Contact: {{ $post->user->contact ?? '6798476847'}}</p>
                                @endif
                                <p class="text-blue-700 text-sm mt-1">Joined FindIt: {{ $post->user->created_at->format('M Y') ?? 'unknown'}}</p>
                            </div> --}}
                        {{-- @endif --}}
                    {{-- @else --}}
                        {{-- Default "Posted by" and "Contact" for guests (not logged in) --}}
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md mb-6">
                            <h3 class="text-xl font-semibold text-blue-800 mb-2">About the Poster</h3>
                            <p class="text-blue-700 text-base">
                                This item was posted by: <strong class="text-blue-900">{{ $post->user->name ?? 'A humble Findit user'}}</strong>.
                                They are the one who either lost this item or found it.
                            </p>
                            {{-- @if($post->user->email) --}}
                            <p class="text-blue-700 text-sm mt-1">Email: {{ $post->user->email ?? 'user@gmail.com'}}</p>
                            {{-- @endif --}}
                            {{-- @if($post->user->contact) --}}
                            <p class="text-blue-700 text-sm mt-1">Contact: {{ $post->contact ?? '6798476847'}}</p> 
                            {{-- @endif --}}
                            <p class="text-blue-700 text-sm mt-1">Joined FindIt: {{ '10 may 2025'}}</p>
                        </div>
                    @endauth

                   
                </div>
            </div>
        </div>
    </div>


    <script>
        // Carousel functionality
        let currentImageIndex = 0;
        const images = document.querySelectorAll('[data-carousel-image]');
        const totalImages = images.length;
        let fullscreenImages = [];
        let currentFullscreenIndex = 0;

        function showImage(index) {
            images.forEach(img => img.classList.add('opacity-0'));
            images[index].classList.remove('opacity-0');
            currentImageIndex = index;
        }

        function nextImage() {
            const nextIndex = (currentImageIndex + 1) % totalImages;
            showImage(nextIndex);
        }

        function prevImage() {
            const prevIndex = (currentImageIndex - 1 + totalImages) % totalImages;
            showImage(prevIndex);
        }

        // Fullscreen functionality
        function openFullscreen(src) {
            const fullscreenViewer = document.getElementById('fullscreen-viewer');
            const fullscreenImage = document.getElementById('fullscreen-image');

            fullscreenImage.src = src;
            fullscreenViewer.classList.remove('hidden');
            fullscreenViewer.classList.add('flex');
            document.body.classList.add('overflow-hidden');

            // Set up fullscreen navigation
            fullscreenImages = Array.from(images).map(img => img.src);
            currentFullscreenIndex = Array.from(images).findIndex(img => img.src.includes(src.split('/').pop()));
        }

        function closeFullscreen() {
            document.getElementById('fullscreen-viewer').classList.add('hidden');
            document.getElementById('fullscreen-viewer').classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function fullscreenNextImage() {
            currentFullscreenIndex = (currentFullscreenIndex + 1) % fullscreenImages.length;
            document.getElementById('fullscreen-image').src = fullscreenImages[currentFullscreenIndex];
        }

        function fullscreenPrevImage() {
            currentFullscreenIndex = (currentFullscreenIndex - 1 + fullscreenImages.length) % fullscreenImages.length;
            document.getElementById('fullscreen-image').src = fullscreenImages[currentFullscreenIndex];
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            const fullscreenViewer = document.getElementById('fullscreen-viewer');
            if (!fullscreenViewer.classList.contains('hidden')) {
                if (e.key === 'Escape') closeFullscreen();
                if (e.key === 'ArrowRight') fullscreenNextImage();
                if (e.key === 'ArrowLeft') fullscreenPrevImage();
            }
        });
    </script>
</x-app-layout>