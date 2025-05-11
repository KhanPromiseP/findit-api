<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Search Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-blue-800 mb-2">Search Lost Items</h1>
                <p class="text-lg text-blue-600">Find items that may belong to you</p>
            </div>

            <!-- Search Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8 mb-12">
                <form id="searchForm" class="space-y-6" action="{{ route('find.search') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Item Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-blue-800 mb-1">Item Name</label>
                            <input type="text" id="name" name="name" placeholder="e.g. Black Wallet, iPhone 12" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-blue-800 mb-1">Color</label>
                            <input type="text" id="color" name="color" placeholder="e.g. Black, Silver, Red" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-blue-800 mb-1">Location</label>
                            <input type="text" id="location" name="location" placeholder="Where you lost it" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Category Dropdown -->
                        <div class="md:col-span-3">
                            <label for="category_id" class="block text-sm font-medium text-blue-800 mb-1">Category</label>
                            <select id="category_id" name="category_id" 
                                    class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 appearance-none bg-white bg-[url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233b82f6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e")] bg-no-repeat bg-[right_1rem_center]">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full md:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search Items
                        </button>
                    </div>
                </form>
            </div>

            <!-- Search Results Section -->
            @if(isset($lostItems))
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-blue-800">Search Results</h2>
                    <p class="text-blue-600">{{ $lostItems->count() }} item(s) found</p>
                </div>

                @if($lostItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($lostItems as $item)
                        <div class="item-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-blue-100">
                            @if($item->images->count() > 0)
                                <div class="h-48 bg-blue-50 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}" 
                                         class="max-h-full max-w-full object-contain p-4">
                                </div>
                            @else
                                <div class="h-48 bg-blue-50 flex items-center justify-center text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-blue-800 mb-2">{{ $item->name }}</h4>
                                
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                        </svg>
                                        <span><strong class="font-medium">Color:</strong> {{ $item->color }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span><strong class="font-medium">Location:</strong> {{ $item->location }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span><strong class="font-medium">Category:</strong> {{ $item->category->name }}</span>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-blue-100 flex justify-between items-center">
                                    <small class="text-gray-500">Posted {{ $item->created_at->diffForHumans() }}</small>
                                    <button class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition-colors duration-300">
                                        Claim Item
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-blue-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-medium text-blue-800 mb-2">No items found</h3>
                        <p class="text-blue-600">Try adjusting your search criteria</p>
                    </div>
                @endif
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-blue-400 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-2xl font-medium text-blue-800 mb-4">Search for lost items</h3>
                <p class="text-blue-600 max-w-md mx-auto">Fill out the search form above to find items that match your criteria.</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Enhanced search form submission
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Searching...
            `;
        });

        // Image preview functionality (if needed)
        const imageInput = document.getElementById('images');
        const preview = document.getElementById('preview');

        if (imageInput && preview) {
            imageInput.addEventListener('change', () => {
                preview.innerHTML = '';
                const files = Array.from(imageInput.files);

                if (files.length > 3) {
                    alert("You can upload a maximum of 3 images.");
                    imageInput.value = '';
                    return;
                }

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-32 h-32 object-cover rounded-lg shadow-md mr-2 mb-2';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        }
    </script>
</x-app-layout>