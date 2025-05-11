<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to all items
                </a>
            </div>

            <!-- Item Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Image Gallery -->
                @if($post->LostItemImages->count() > 0)
                    <div class="relative h-64 sm:h-80 md:h-96 bg-gray-100">
                        <img src="{{ asset('storage/'.$post->LostItemImages->first()->image_path) }}" 
                             alt="{{ $post->name }}" 
                             class="w-full h-full object-cover">
                        
                        @if($post->LostItemImages->count() > 1)
                            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                                @foreach($post->LostItemImages as $image)
                                    <button class="w-3 h-3 rounded-full bg-white bg-opacity-60 hover:bg-opacity-100 transition"
                                            onclick="changeImage('{{ asset('storage/'.$image->image_path) }}')">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-64 sm:h-80 md:h-96 bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

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

    @if($post->LostItemImages->count() > 1)
    <script>
        function changeImage(src) {
            document.querySelector('.relative img').src = src;
        }
    </script>
    @endif
</x-app-layout>