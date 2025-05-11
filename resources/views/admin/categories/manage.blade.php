<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Category Management</h2>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Create Category Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-700 mb-3">Add New Category</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-3">
                        @csrf
                        <div class="flex-grow">
                            <input type="text" name="name" id="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Category name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Add
                        </button>
                    </form>
                </div>

                <!-- Categories List -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-3">Existing Categories</h3>
                    
                    <!-- Status Messages -->
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-md border border-green-100">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-md border border-red-100">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Categories Table -->
                    @if($categories->count() > 0)
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($categories as $category)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $category->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $category->lost_item_posts_count }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                                        class="text-red-600 hover:text-red-800">
    
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 rounded-md text-center text-gray-500 border border-gray-200">
                            No categories found. Add your first category above.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>