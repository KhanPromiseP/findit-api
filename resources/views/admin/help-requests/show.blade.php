<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Help Request Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Help Request Details</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.help-requests.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Back to List
                            </a>
                            @if($helpRequest->status !== 'resolved')
                            <form method="POST" action="{{ route('admin.help-requests.update', $helpRequest->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="resolved">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Mark as Resolved
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    {{-- Admin Pre-message/Note --}}
                    <div class="bg-blue-50 rounded-lg p-4 mb-6 border border-blue-200 text-blue-800">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9.293 12.293a1 1 0 00.174.195l1.414 1.414a1 1 0 001.414 0l1.414-1.414a1 1 0 000-1.414l-1.414-1.414a1 1 0 00-1.414 0l-1.414 1.414a1 1 0 00-.195-.174z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 md:flex md:justify-between">
                                <p class="text-sm">
                                    @if($helpRequest->status === 'resolved')
                                    This help request from <strong>{{ $helpRequest->user->name }}</strong> has been resolved. You can reopen it if needed.
                                    @else
                                    This is a help request from <strong>{{ $helpRequest->user->name }}</strong>. Current status: <span class="font-bold">{{ ucwords(str_replace('_', ' ', $helpRequest->status)) }}</span>.
                                    @endif
                                </p>
                                <p class="text-sm md:ml-2 mt-2 md:mt-0">
                                    Request ID: <span class="font-mono">{{ $helpRequest->id }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Request Details</h3>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($helpRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($helpRequest->status === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucwords(str_replace('_', ' ', $helpRequest->status)) }}
                            </span>
                        </div>

                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Item Information</h4>
                                    <div class="space-y-2">
                                        <p class="text-gray-600"><strong>Name:</strong> {{ $helpRequest->name }}</p>
                                        <p class="text-gray-600"><strong>Category:</strong> {{ $helpRequest->category->name }}</p>
                                        <p class="text-gray-600"><strong>Color:</strong> {{ $helpRequest->color ?? 'Not specified' }}</p>
                                        <p class="text-gray-600"><strong>Location Lost:</strong> {{ $helpRequest->location }}</p>
                                        {{-- <p class="text-gray-600"><strong>Date Lost:</strong> {{ $helpRequest->date_lost ? $helpRequest->date_lost->format('M d, Y') : 'Not specified' }}</p> --}}
                                        <p class="text-gray-600"><strong>Reward Offered:</strong> {{ $helpRequest->reward ?? 'None' }}</p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-lg font-semibold text-gray-700 mb-2">User Information</h4>
                                    <div class="space-y-2">
                                        <p class="text-gray-600"><strong>Submitted By:</strong>
                                            <a href="{{ route('admin.users', $helpRequest->user->id) }}" class="text-indigo-600 hover:text-indigo-800">
                                                {{ $helpRequest->user->name }}
                                            </a>
                                        </p>
                                        <p class="text-gray-600">
                                            <strong>Contact Phone:</strong>
                                            {{-- Display contact as text --}}
                                            <span class="mr-1">{{ $helpRequest->contact ?? 'N/A' }}</span>
                                            {{-- WhatsApp link --}}
                                            @php
                                                $cleanedHelpRequestContact = preg_replace('/\D/', '', $helpRequest->contact ?? ''); // Clean contact number
                                                $whatsAppMessage = urlencode("Hello! I'm contacting you regarding your lost item: '{$helpRequest->name}' (ID: {$helpRequest->id}).");
                                            @endphp
                                            @if($cleanedHelpRequestContact)
                                                <a href="https://wa.me/{{ $cleanedHelpRequestContact }}?text={{ $whatsAppMessage }}" target="_blank"
                                                   class="text-green-600 hover:text-green-800" title="Chat on WhatsApp">
                                                   <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic text-sm">(No WhatsApp contact)</span>
                                            @endif
                                            {{-- Tel link --}}
                                            @if($cleanedHelpRequestContact)
                                                <a href="tel:{{ $cleanedHelpRequestContact }}" class="text-blue-600 hover:text-blue-800 ml-2" title="Call">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            @endif
                                        </p>
                                        <p class="text-gray-600"><strong>Submitted On:</strong> {{ $helpRequest->created_at->format('M d, Y H:i') }}</p>
                                        <p class="text-gray-600"><strong>Last Updated:</strong> {{ $helpRequest->updated_at->format('M d, Y H:i') }}</p>
                                    </div>

                                    <div class="mt-6">
                                        <h4 class="text-lg font-semibold text-gray-700 mb-2">Update Status</h4>
                                        <form method="POST" action="{{ route('admin.help-requests.update', $helpRequest->id) }}" class="flex items-end space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex-grow">
                                                <select name="status" id="status" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                    <option value="pending" {{ $helpRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in_progress" {{ $helpRequest->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="resolved" {{ $helpRequest->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                Update
                                            </button>
                                        </form>
                                    </div>

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        {{-- Share on WhatsApp button (opens modal for multiple selections) --}}
                                        {{-- <button @click="showWhatsappShareModal = true; fetchContacts();"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fab fa-whatsapp mr-2"></i> Share on WhatsApp (Bulk)
                                        </button> --}}

                                        {{-- Email User (opens user's mail client) --}}
                                        <a href="mailto:{{ $helpRequest->user->email }}?subject=Regarding your lost item ({{ urlencode($helpRequest->name) }})&body={{ urlencode("Dear " . $helpRequest->user->name . ",\n\n") }}"
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fas fa-envelope mr-2"></i> Email Owner
                                        </a>

                                        {{-- Announce to All Users (sends email from backend) --}}
                                        <button @click="showEmailToAllUsersModal = true"
                                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fas fa-bullhorn mr-2"></i> Announce to subscribers
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h4 class="text-lg font-semibold text-gray-700 mb-2">Description</h4>
                                <div class="border border-gray-300 p-4 bg-gray-50 rounded-md text-gray-700 whitespace-pre-line">
                                    {{ $helpRequest->description }}
                                </div>
                            </div>

                            @if($helpRequest->images->count() > 0)
                            <div class="mt-6">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-lg font-semibold text-gray-700">Images</h4>
                                    <span class="text-sm text-gray-500">{{ $helpRequest->images->count() }} image(s)</span>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    @foreach($helpRequest->images as $image)
                                    <div class="group relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="Help request image"
                                             class="w-full h-40 object-cover rounded-lg shadow-md cursor-pointer hover:opacity-90 transition-opacity"
                                             @click="window.open('{{ asset('storage/' . $image->image_path) }}', '_blank')">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all rounded-lg"></div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Admin Notes Section --}}
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                <i class="fas fa-clipboard mr-2 text-gray-600"></i>
                                Admin Notes
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            @if($helpRequest->notes)
                                <div class="prose max-w-none">
                                    {!! Str::markdown($helpRequest->notes) !!}
                                </div>
                            @else
                                <p class="text-gray-500 italic">No admin notes added yet.</p>
                            @endif

                            <form method="POST" action="{{ route('admin.help-requests.update', $helpRequest->id) }}" class="mt-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Add/Update Notes</label>
                                    <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes', $helpRequest->notes) }}</textarea>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Save Notes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
   
            </div>
        </div>
    </div>
</x-admin-layout>