<x-admin-layout>
    <h2 class="text-2xl font-semibold mb-4">Approved Posts</h2>

    @if (session('success'))
        <div class="bg-green-200 border-green-500 text-green-700 p-4 mb-4 rounded-md">{{ session('success') }}</div>
    @endif

    @if (count($approvedPosts) > 0)
        <div class="overflow-x-auto">
            <table class="w-full border-collapse shadow-md rounded-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left w-1/6">Name</th>
                        <th class="py-3 px-4 border-b text-left w-2/6">Description</th>
                        <th class="py-3 px-4 border-b text-left w-1/6">Posted By</th>
                        <th class="py-3 px-4 border-b text-left w-1/6">Contact</th>
                        <th class="py-3 px-4 border-b text-left w-1/6">Approved At</th>
                        <th class="py-3 px-4 border-b text-left w-1/6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvedPosts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ Str::limit($post->name, 20) }}</td>
                            <td class="py-3 px-4 border-b text-sm overflow-hidden">
                                <div class="max-h-20 overflow-y-auto max-w-xs truncate">
                                    {{ $post->description }}
                                </div>
                            </td>
                            <td class="py-3 px-4 border-b">{{ $post->user->name }}</td>
                            <td class="py-3 px-4 border-b">
                                <a href="https://wa.me/{{ $post->contact }}?text={{ urlencode('Regarding your post: ' . $post->name) }}"
                                   class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-3 rounded inline-block whitespace-nowrap"
                                   target="_blank">
                                   Contact
                                </a>
                            </td>
                            <td class="py-3 px-4 border-b text-sm whitespace-nowrap">
                                {{ $post->approved_at->format('M d, Y') }}
                            </td>
                            <td class="py-3 px-4 border-b">
                               <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="inline delete-post-form" data-post-id="{{ $post->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded delete-post-btn">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4 border-b">
                               <a href="{{ route('posts.show', $post->id) }}" 
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                View
                            </a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">No approved posts found.</p>
    @endif
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deletePostForms = document.querySelectorAll('.delete-post-form');

        deletePostForms.forEach(form => {
            const deleteButton = form.querySelector('.delete-post-btn');
            const postId = form.dataset.postId;
            const rowToRemove = form.closest('tr'); 

            deleteButton.addEventListener('click', function (event) {
                if (confirm('Are you sure you want to delete this post?')) {
                    const url = form.getAttribute('action');
                    const formData = new FormData(form);

                    fetch(url, {
                        method: 'POST', 
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' 
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            if (rowToRemove) {
                                rowToRemove.remove();
                            }

                            const successDiv = document.createElement('div');
                            successDiv.className = 'bg-green-200 border-green-500 text-green-700 p-4 mb-4 rounded-md';
                            successDiv.textContent = 'Post deleted successfully.';

                            const container = document.querySelector('.overflow-x-auto') || document.body; 
                            container.insertBefore(successDiv, container.firstChild);

                            setTimeout(() => {
                                successDiv.remove();
                            }, 3000);

                        } else {
                          
                            console.error('Error deleting post:', response);
                            alert('An error occurred while deleting the post.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('An error occurred while deleting the post.');
                    });
                }
            });
        });
    });
</script>
</x-admin-layout>