<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-blue-800 mb-2">Report Found Item</h1>
                <p class="text-lg text-blue-600">Help reunite lost items with their owners</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <form id="foundItemForm" class="space-y-6" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="status" value="found">

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Object Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-blue-800 mb-1">Object Name</label>
                            <input type="text" id="name" name="name" placeholder="e.g. Black Wallet, iPhone 12" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-blue-800 mb-1">Color</label>
                            <input type="text" id="color" name="color" placeholder="e.g. Black, Silver, Red" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Location Found -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-blue-800 mb-1">Location Found</label>
                            <input type="text" id="location" name="location" placeholder="e.g. Main Library, Room 203" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact" class="block text-sm font-medium text-blue-800 mb-1">Contact Number</label>
                            <input type="text" id="contact" name="contact" placeholder="Your phone number" 
                                   class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                   required>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="md:col-span-2">
                            <label for="category_id" class="block text-sm font-medium text-blue-800 mb-1">Category</label>
                            <select id="category_id" name="category_id" 
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
                            <label for="description" class="block text-sm font-medium text-blue-800 mb-1">Detailed Description</label>
                            <textarea id="description" name="description" rows="4" placeholder="Describe the item in detail (brand, model, distinguishing features, etc.)"
                                      class="w-full px-4 py-3 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                      required></textarea>
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
                                        <label for="image_path" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload files</span>
                                            <input id="image_path" name="image_path[]" type="file" class="sr-only" accept="image/*" multiple required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 3MB each (max 4 images)</p>
                                </div>
                            </div>
                            <!-- Image Preview -->
                            <div id="preview" class="mt-4 flex flex-wrap gap-4"></div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Found Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('foundItemForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitButton = this.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;

        const formData = new FormData(this);

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
            if(data.success) {
                window.location.href = data.redirect || "{{ route('posts.index') }}";
            } else {
                throw new Error(data.message || 'Failed to submit form');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error: ' + error.message);
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    });

        // Enhanced Image Preview
        document.getElementById('image_path').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            if(this.files && this.files.length > 0) {
                // Limit to 3 images
                const files = Array.from(this.files).slice(0, 4);
                
                files.forEach((file, index) => {
                    if (!file.type.match('image.*')) {
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'relative group';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-32 h-32 object-cover rounded-lg shadow-md';
                        
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.onclick = function() {
                            previewItem.remove();
                            // Create new FileList without the removed image
                            const dataTransfer = new DataTransfer();
                            Array.from(document.getElementById('image_path').files)
                                .filter((_, i) => i !== index)
                                .forEach(file => dataTransfer.items.add(file));
                            document.getElementById('image_path').files = dataTransfer.files;
                        };
                        
                        previewItem.appendChild(img);
                        previewItem.appendChild(removeBtn);
                        preview.appendChild(previewItem);
                    }
                    reader.readAsDataURL(file);
                });

                // Update file input if more than 4 files were selected
                if (this.files.length > 4) {
                    const dataTransfer = new DataTransfer();
                    files.forEach(file => dataTransfer.items.add(file));
                    this.files = dataTransfer.files;
                }
            }
        });

        // Drag and drop functionality
        const dropArea = document.querySelector('.border-dashed');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight() {
            dropArea.classList.remove('border-blue-500', 'bg-blue-50');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('image_path').files = files;
            
            // Trigger the change event manually
            const event = new Event('change');
            document.getElementById('image_path').dispatchEvent(event);
        }
    </script>
</x-app-layout>