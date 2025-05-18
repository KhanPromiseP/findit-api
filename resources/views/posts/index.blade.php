<x-admin-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-blue-800 mb-2">Lost & Found Items</h1>
                <p class="text-lg text-blue-600">Browse recently reported items</p>
                <div class="mt-4">
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Report Found Item
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-8">
                <form action="{{ route('posts.index') }}" method="GET" class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search items..." 
                        value="{{ request('search') }}"
                        class="flex-1 px-4 py-2 rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition duration-150"
                    >
                        Search
                    </button>
                </form>
            </div>

            <!-- Items Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Image -->
                        @if($post->LostItemImages?->first())
                            <div class="h-48 overflow-hidden">
                                <img 
                                    src="{{ asset('storage/' . $post->LostItemImages->first()->image_path) }}" 
                                    alt="{{ $post->name }}" 
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6">
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
                            
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->description, 100) }}</p>
                            
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $post->location }}
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Posted by {{ $post->user->name }}
                            </div>
                            
                            <a 
                                href="{{ route('posts.show', $post) }}" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-150"
                            >
                                View Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No items found</h3>
                        <p class="mt-1 text-gray-500">There are currently no lost or found items to display.</p>
                        <div class="mt-6">
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                                Report a Found Item
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>