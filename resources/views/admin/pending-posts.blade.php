<x-admin-layout>
    <h2 class="text-2xl font-semibold mb-6">Pending Posts</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($pendingPosts && count($pendingPosts) > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Posted By
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pendingPosts as $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $post->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $post->description }}">
                                    {{ $post->description }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $post->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="inline delete-post-form" data-post-id="{{ $post->id }}">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Approve
                                        </button>
                                    </form>
                                     <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="inline delete-post-form" data-post-id="{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded delete-post-btn">
                                            Reject
                                        </button>
                                    </form>
                                    <a href="{{ route('posts.show', $post->id) }}" 
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $pendingPosts->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500">No pending posts awaiting approval.</p>
        </div>
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