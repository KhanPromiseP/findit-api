<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Successful!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="text-2xl font-bold">Payment Confirmed</h3>
                            <p class="opacity-90">Thank you for your purchase!</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Transaction Reference</h4>
                            <p class="font-semibold text-gray-900">{{ $txRef }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Amount Paid</h4>
                            <p class="font-semibold text-gray-900">{{ $amount }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Date & Time</h4>
                            <p class="font-semibold text-gray-900">{{ now()->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Payment Method</h4>
                            <p class="font-semibold text-gray-900">{{ $paymentMethod ?? 'Card' }}</p>
                        </div>
                    </div>

                    <!-- Order Summary (if applicable) -->
                    @if(isset($orderItems))
                    <div class="border-t pt-4">
                        <h4 class="font-medium text-lg mb-3">Order Summary</h4>
                        <div class="space-y-3">
                            @foreach($orderItems as $item)
                            <div class="flex justify-between">
                                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                <span class="font-medium">{{ $item['price'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="border-t mt-3 pt-3 flex justify-between font-medium">
                            <span>Total</span>
                            <span>{{ $amount }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <a href="{{ route('invoice.download', $invoiceId) }}"
                           class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-md transition duration-300 text-center font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Download Invoice</span>
                        </a>
                        
                        <a href="{{ route('orders.index') }}"
                           class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-3 rounded-md transition duration-300 text-center font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>View Orders</span>
                        </a>
                        
                        <a href="{{ url('/') }}"
                           class="flex-1 text-indigo-600 hover:text-indigo-800 px-5 py-3 rounded-md transition duration-300 text-center font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Return Home</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support Section -->
            <div class="mt-8 bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-6">
                    <h4 class="font-medium text-lg mb-3">Need Help?</h4>
                    <p class="text-gray-600 mb-4">If you have any questions about your payment, please contact our support team.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        Contact Support
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>