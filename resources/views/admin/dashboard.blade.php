<x-admin-layout>
    <div class="bg-gray-100 min-h-screen p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 flex items-center justify-between">
                    <div class="">
                        <h3 class="text-lg font-semibold text-blue-600 mb-2">Pending Posts</h3>
                        <p class="text-3xl font-bold text-gray-700">{{ count($pendingPosts) }}</p>
                    </div>
                    <div class="text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                </div>
                <div class="bg-blue-50 py-3 text-center">
                    <a href="{{ route('admin.pending-posts') }}" class="text-blue-700 hover:underline font-medium text-sm">View Details</a>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 flex items-center justify-between">
                    <div class="">
                        <h3 class="text-lg font-semibold text-green-600 mb-2">Approved Posts</h3>
                        <p class="text-3xl font-bold text-gray-700">{{ count($approvedPosts) }}</p>
                    </div>
                    <div class="text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="bg-green-50 py-3 text-center">
                    <a href="{{ route('admin.approved-posts') }}" class="text-green-700 hover:underline font-medium text-sm">View Details</a>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 flex items-center justify-between">
                    <div class="">
                        <h3 class="text-lg font-semibold text-indigo-600 mb-2">Users</h3>
                        <p class="text-3xl font-bold text-gray-700">{{ count($users) }}</p>
                    </div>
                    <div class="text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.125h15.003m-15.003-5.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm10.5-5.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </div>
                </div>
                <div class="bg-indigo-50 py-3 text-center">
                    <a href="{{ route('admin.users') }}" class="text-indigo-700 hover:underline font-medium text-sm">View Details</a>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>