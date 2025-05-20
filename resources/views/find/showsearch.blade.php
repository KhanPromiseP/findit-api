<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
           <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center bg-blue-200 text-blue-600 hover:bg-blue-300 hover:text-blue-800 px-4 py-2 rounded-md transition">
                    Back to all items
                </a>
            </div>



            <!-- Item Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Image Gallery -->
                @if($post->LostItemImages->count() > 0)
                    <div class="relative h-64 sm:h-80 md:h-96 bg-gray-100 overflow-hidden group">
                        <!-- Carousel Container -->
                        <div class="relative h-full w-full">
                            @foreach($post->LostItemImages as $index => $image)
                                <img src="{{ asset('storage/'.$image->image_path) }}" 
                                    alt="{{ $post->name }}" 
                                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                                    data-carousel-image="{{ $index }}"
                                    onclick="openFullscreen('{{ asset('storage/'.$image->image_path) }}')">
                            @endforeach
                        </div>

                        <!-- Navigation Dots -->
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

                        <!-- Navigation Arrows -->
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

                <!-- Fullscreen Image Viewer -->
                <div id="fullscreen-viewer" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
                    <button class="absolute top-4 right-4 text-white text-3xl" onclick="closeFullscreen()">&times;</button>
                    <img id="fullscreen-image" class="max-w-full max-h-full object-contain" src="" alt="">
                    
                    @if($post->LostItemImages->count() > 1)
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-3xl" onclick="fullscreenPrevImage()">❮</button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-3xl" onclick="fullscreenNextImage()">❯</button>
                    @endif
                </div>

               
                <!-- Item Details -->
                <div class="p-6 sm:p-8">
                   <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-800">{{ $post->name }}</h2>
                        <div class="flex flex-col items-end">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if(!$post->is_approved)
                                    bg-yellow-100 text-yellow-800
                                @else
                                    {{ $post->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}
                                @endif">
                                @if(!$post->is_approved)
                                    Pending Approval
                                @else
                                    {{ ucfirst($post->status) }} (Approved)
                                @endif
                            </span>
                            
                            @if($post->is_approved && $post->approved_at)
                                <span class="text-xs text-gray-500 mt-1">
                                    Approved on: {{ $post->approved_at->format('M d, Y h:i A') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                        <div class="p-6">
                                <h4 class="text-xl font-bold text-blue-800 mb-2">{{ $post->name }}</h4>
                                
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                        </svg>
                                         @if($post->color)
                                            <div class="">
                                                <span class="text-sm font-medium text-gray-700">Color:</span>
                                                <span class="ml-2 px-3 py-1 rounded-full text-sm" 
                                                    style="background-color: {{ $post->color }}; color: white; text-shadow: 0 0 2px rgba(0,0,0,0.5)">
                                                    {{ $post->color }}
                                                </span>
                                            </div>
                                        @endif

                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span><strong class="font-medium">Location:</strong> {{ $post->location }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span><strong class="font-medium">Category:</strong> {{ $post->category->name }}</span>
                                    </div>

                                   
                                </div>

                                 <!-- Description -->
                                    <div class="mt-8">
                                    
                                        <span class="text-2lx font-medium text-blue-700 text-bold">Description:</span>
                                        <p class="text-gray-700 whitespace-pre-line">{{ $post->description }}</p>
                                    </div>
                        {{-- <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Posted by {{ $post->user->name }}
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $post->contact }}
                        </div> --}}
                    </div>

                   

                   

                    
                </div>
                 <!-- Action Buttons -->
                       
                        <div class="flex-right mt-4 pt-4 border-t border-blue-100 flex justify-between items-center">
                            <small class="text-gray-500">Posted {{ $post->created_at->diffForHumans() }}</small>
                            <button class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition-colors duration-300">
                                Claim Item
                            </button>
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