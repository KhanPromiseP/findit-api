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
                            {{ $post->category->name }}
                        </div>
                        <div class="flex items-center">
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
                        </div>
                    </div>

                    <!-- Color Indicator -->
                    @if($post->color)
                    <div class="mb-6">
                        <span class="text-sm font-medium text-gray-700">Color:</span>
                        <span class="ml-2 px-3 py-1 rounded-full text-sm" 
                              style="background-color: {{ $post->color }}; color: white; text-shadow: 0 0 2px rgba(0,0,0,0.5)">
                            {{ $post->color }}
                        </span>
                    </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $post->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    @if(auth()->id() === $post->user_id)
                        <div class="flex space-x-4">
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
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
    </script>2
</x-app-layout>