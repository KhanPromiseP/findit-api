<x-admin-layout>
    <div class="bg-gray-100 min-h-screen p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 flex items-center justify-between">
                    <div class="">
                        <h3 class="text-lg font-semibold text-blue-600 mb-2">Pending Posts</h3>
                         <p class="text-3xl font-bold text-gray-700">{{ count($pendingPosts ?? []) }}</p>
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
                        <p class="text-3xl font-bold text-gray-700">{{ count($approvedPosts ?? []) }}</p>
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
                        <p class="text-3xl font-bold text-gray-700">{{ count($users ?? []) }}</p>
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



         <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <!-- Total Payments Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 flex items-center justify-between">
            <div class="">
                <h3 class="text-lg font-semibold text-blue-600 mb-2">Total Payments</h3>
                <p class="text-3xl font-bold text-gray-700">{{ ($totalPayments) }}</p>
            </div>
            <div class="text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                </svg>
            </div>
        </div>
        <div class="bg-blue-50 py-3 text-center">
            <a href="{{ route('admin.payments') }}" class="text-blue-700 hover:underline font-medium text-sm">View Payment Records</a>
        </div>
    </div>

    <!-- Help Requests Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 flex items-center justify-between">
            <div class="">
                <h3 class="text-lg font-semibold text-green-600 mb-2">Help Requests</h3>
                <p class="text-3xl font-bold text-gray-700">{{ $helpRequestsCount }}</p>
            </div>
            <div class="text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
        </div>
        <div class="bg-green-50 py-3 text-center">
            <a href="{{ route('admin.help-requests.index') }}" class="text-green-700 hover:underline font-medium text-sm">View Requests</a>
        </div>
    </div>

    <!-- Found Items Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 flex items-center justify-between">
            <div class="">
                <h3 class="text-lg font-semibold text-indigo-600 mb-2">Found Items</h3>
                <p class="text-3xl font-bold text-gray-700">{{ $foundItemsCount }}</p>
            </div>
            <div class="text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </div>
        </div>
        <div class="bg-indigo-50 py-3 text-center">
            <a href="{{ route('admin.found-items') }}" class="text-indigo-700 hover:underline font-medium text-sm">View Found Items</a>
        </div>
    </div>
</div>


    </div>
</x-admin-layout>