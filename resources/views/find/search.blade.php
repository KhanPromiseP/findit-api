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
                                    <a href="{{ route('find.showsearch', $item->id) }}" 
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        View
                                    </a>
                                    <a href="{{ route('payment.form') }}" 
                                        class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition-colors duration-300 inline-block">
                                        Claim Item
                                    </a>

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
                        <h3 class="text-xl font-medium text-blue-800 mb-2">No items found matching your search</h3>
                        <p class="text-blue-600 mb-6">Try adjusting your search criteria or check back later</p>
                        
                        <!-- Enhanced "Can't Find Your Item" Section -->
                        <div class="bg-blue-50 rounded-xl p-6 max-w-2xl mx-auto border border-blue-200">
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="text-center md:text-left">
                                    <h4 class="text-lg font-bold text-blue-800 mb-2">Can't Find Your Item?</h4>
                                    <p class="text-blue-700 mb-4">Let us help you! Our team will actively search for your lost item and notify our community.</p>
                                    <button onclick="openHelpModal()" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition-colors duration-300 flex items-center justify-center gap-2 mx-auto md:mx-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Request Help Finding My Item
                                    </button>
                                </div>
                            </div>
                        </div>
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

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeHelpModal()"></div>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-blue-800" id="modal-title">Help Find My Item</h3>
                        <button type="button" onclick="closeHelpModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="mt-2 text-blue-600">Please provide details about your lost item. Our team will help search for it.</p>
                </div>
                
                <!-- Form Container -->
                <form id="helpFindForm" action="{{ route('find.help-request') }}" method="POST" enctype="multipart/form-data" class="px-6 pb-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Object Name -->
                        <div>
                            <label for="help_name" class="block text-sm font-medium text-blue-800 mb-1">Item Name*</label>
                            <input type="text" id="help_name" name="name" placeholder="e.g. Black Wallet, iPhone 12" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="help_color" class="block text-sm font-medium text-blue-800 mb-1">Color*</label>
                            <input type="text" id="help_color" name="color" placeholder="e.g. Black, Silver, Red" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Location Lost -->
                        <div>
                            <label for="help_location" class="block text-sm font-medium text-blue-800 mb-1">Location Lost*</label>
                            <input type="text" id="help_location" name="location" placeholder="Where you lost it" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="help_contact" class="block text-sm font-medium text-blue-800 mb-1">Contact Number*</label>
                            <input type="text" id="help_contact" name="contact" placeholder="Your phone number" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="md:col-span-2">
                            <label for="help_category_id" class="block text-sm font-medium text-blue-800 mb-1">Category*</label>
                            <select id="help_category_id" name="category_id" 
                                    class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 appearance-none bg-white bg-[url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233b82f6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e")] bg-no-repeat bg-[right_1rem_center]"
                                    required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="help_description" class="block text-sm font-medium text-blue-800 mb-1">Detailed Description*</label>
                            <textarea id="help_description" name="description" rows="4" placeholder="Describe the item in detail (brand, model, distinguishing features, etc.)"
                                      class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                      required></textarea>
                        </div>

                        <!-- Date Lost -->
                        <div>
                            <label for="date_lost" class="block text-sm font-medium text-blue-800 mb-1">Date Lost (Approximate)</label>
                            <input type="date" id="date_lost" name="date_lost" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Reward Offered -->
                        <div>
                            <label for="reward" class="block text-sm font-medium text-blue-800 mb-1">Reward Offered</label>
                            <input type="text" id="reward" name="reward" placeholder="Optional" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-blue-800 mb-1">Upload Images (max 4)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-blue-300 rounded-xl hover:border-blue-500 transition duration-300">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-blue-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="help_images" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload files</span>
                                            <input id="help_images" name="images[]" type="file" class="sr-only" accept="image/*" multiple>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 3MB each (max 4 images)</p>
                                </div>
                            </div>
                            <!-- Image Preview -->
                            <div id="help_preview" class="mt-4 flex flex-wrap gap-4"></div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeHelpModal()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg shadow-sm transition-colors duration-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition-colors duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Submit Help Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Success Modal (for user) -->
    <div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="success-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-green-600" id="success-modal-title">Request Submitted!</h3>
                        <button type="button" onclick="closeSuccessModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="px-6 pb-6">
                    <div class="bg-green-50 rounded-xl p-6 mb-6 border border-green-200">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-green-800 mb-2">Thank you, <span id="userName"></span>!</h4>
                                <p class="text-green-700">We've received your request and will handle it with the utmost priority. Our team will contact you if we find a match.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <button onclick="closeSuccessModal()" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition-colors duration-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>
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

        // Modal functions
        function openHelpModal() {
            document.getElementById('helpModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeHelpModal() {
            document.getElementById('helpModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // In your form submission success handler
        openSuccessModal(formData.get('name'));

        // Simplified success modal function
        function openSuccessModal(userName) {
            document.getElementById('userName').textContent = userName;
            document.getElementById('successModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            closeHelpModal();
        }

        function copyShareText() {
            const text = document.getElementById('shareMessage').textContent;
            navigator.clipboard.writeText(text).then(() => {
                alert('Message copied to clipboard!');
            });
        }

        // Image preview for help form
        const helpImageInput = document.getElementById('help_images');
        const helpPreview = document.getElementById('help_preview');

        if (helpImageInput && helpPreview) {
            helpImageInput.addEventListener('change', () => {
                helpPreview.innerHTML = '';
                const files = Array.from(helpImageInput.files);

                if (files.length > 4) {
                    alert("You can upload a maximum of 4 images.");
                    helpImageInput.value = '';
                    return;
                }

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-32 h-32 object-cover rounded-lg shadow-md mr-2 mb-2';
                        helpPreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        }

       document.getElementById('helpFindForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closeHelpModal();
                openSuccessModal(
                    formData.get('name'),
                    formData.get('location'),
                    formData.get('contact')
                );
            } else {
                throw new Error(data.message || 'There was an error submitting your request');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'There was an error submitting your request. Please try again.');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Submit Help Request';
        });
    });
    </script>
</x-app-layout>