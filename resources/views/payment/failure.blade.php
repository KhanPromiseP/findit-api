<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Payment Issue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Error Header -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="text-2xl font-bold">Payment Not Completed</h3>
                            <p class="opacity-90">We encountered an issue with your payment</p>
                        </div>
                    </div>
                </div>

                <!-- Error Details -->
                <div class="p-6 space-y-6">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <strong>Error:</strong> {{ $errorMessage ?? 'Your payment could not be processed' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Transaction Reference</h4>
                            <p class="font-semibold text-gray-900">{{ $txRef ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-500 mb-2">Status</h4>
                            <p class="font-semibold text-gray-900">{{ $status ?? 'Failed' }}</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg">
                        <h4 class="font-medium mb-1">What to do next?</h4>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Check if the payment was deducted from your account</li>
                            <li>Try the payment again using a different payment method</li>
                            <li>Contact your bank if you see any unauthorized charges</li>
                            <li>Our support team is ready to help if you need assistance</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <a href="{{ route('payment.form') }}"
                           class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-md transition duration-300 text-center font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>Try Payment Again</span>
                        </a>
                        
                        <a href="{{ route('contact') }}"
                           class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-3 rounded-md transition duration-300 text-center font-medium flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>Contact Support</span>
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

            <!-- FAQ Section -->
            <div class="mt-8 bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-6">
                    <h4 class="font-medium text-lg mb-3">Common Payment Issues</h4>
                    <div class="space-y-4">
                        <div>
                            <h5 class="font-medium text-gray-800">Insufficient Funds</h5>
                            <p class="text-gray-600 text-sm">Ensure your account has sufficient balance or your credit card has available limit.</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">Card Declined</h5>
                            <p class="text-gray-600 text-sm">Your bank may have declined the transaction. Contact them for more information.</p>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">Technical Issues</h5>
                            <p class="text-gray-600 text-sm">Sometimes temporary technical issues occur. Try again in a few minutes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>