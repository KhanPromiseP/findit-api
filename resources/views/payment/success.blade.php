<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Successful!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong>Success!</strong> Your payment was successful. Thank you for your purchase.
                </div>

                <p class="text-gray-700 mb-4">
                    Transaction Reference: 
                    <span class="font-semibold text-gray-900">{{ $txRef }}</span>
                </p>

                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                    <a href="{{ route('invoice.download', $invoiceId) }}"
                       class="inline-block bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition duration-300 text-center">
                        Download Your Invoice
                    </a>
                    
                    <a href="{{ url('/') }}"
                       class="inline-block text-indigo-600 hover:underline text-sm">
                        Go to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
