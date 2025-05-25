<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="mb-4 text-gray-700">
                    You are about to make a payment of
                    <strong>{{ $currency }} {{ number_format($amount, 2) }}</strong>.
                </p>

                <p class="text-gray-700">Your Name: <strong>{{ $user->name }}</strong></p>
                <p class="text-gray-700 mb-2">Your email: <strong>{{ $user->email }}</strong></p>
                
                {{-- DUMMY PHONE NUMBER INPUT FIELD --}}
                <div class="mb-6">
                    <label for="dummy_phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Input your Mobile Money number:
                    </label>
                    <input type="tel" id="dummy_phone" name="dummy_phone"
                           class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           placeholder="e.g., 67X XXX XXXX"
                           value="{{ $user->contact ?? '' }}"> {{-- Pre-fill with user's contact if available --}}
                    <p class="mt-1 text-sm text-gray-500">
                        Only change your contact if the original one is not with momo!
                    </p>
                </div>
                
                <div id="payment-loading" class="hidden text-center text-indigo-600 font-medium my-4">
                    Processing payment... please wait few  <span id="countdown-seconds"></span> seconds.  
                </div>
                <div id="payment-error" class="hidden text-center text-red-600 font-medium my-4">
                    Payment could not be initiated. Please try again.
                </div>

                <button type="button" id="payNowButton" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                    Pay Now
                </button>
            </div>
        </div>
    </div>

    <div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="success-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-green-600" id="success-modal-title">Payment Successful! 🎉</h3>
                        <button type="button" onclick="closeSuccessModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="px-6 pb-6">
                    <div class="bg-green-50 rounded-xl p-6 mb-6 border border-green-200">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-green-800 mb-2">Great news, {{ $user->name }}!</h4>
                                <p class="text-green-700">
                                    Your payment of **{{ $currency }} {{ number_format($amount, 2) }}** has been successfully received.
                                </p>
                                <p class="text-green-700 mt-2">
                                    You're one step closer to getting your item back! We'll send a confirmation email shortly.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        {{-- Get Your Item Button (redirects to the fake invoice page) --}}
                        <a href="{{ route('posts.found') }}"
                           class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition-colors duration-300 flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            <span>Get Your Item now</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const API_publicKey = "{{ config('flutterwave.public_key') }}";
    const payNowButton = document.getElementById('payNowButton');
    const loading = document.getElementById('payment-loading');
    const error = document.getElementById('payment-error');
    const successModal = document.getElementById('successModal');
    const countdownSeconds = document.getElementById('countdown-seconds');

    // Dummy phone number input
    const dummyPhoneInput = document.getElementById('dummy_phone');

    function openSuccessModal() {
        successModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeSuccessModal() {
        successModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    const customerEmail = "{{ $user->email }}";
    const customerPhone = dummyPhoneInput.value || "{{ $user->contact ?? '' }}";
    const customerName = "{{ $user->name }}";
    const paymentAmount = parseFloat({{ $amount }});
    const paymentCurrency = "{{ $currency }}";

    payNowButton.addEventListener('click', function () {
        if (!dummyPhoneInput.value.trim()) {
            error.textContent = "Please enter a contact number.";
            error.classList.remove('hidden');
            return;
        } else {
            error.classList.add('hidden');
        }

        loading.classList.remove('hidden');
        payNowButton.disabled = true;

        let seconds = 15;
        countdownSeconds.textContent = seconds;

        const interval = setInterval(function() {
            seconds--;
            countdownSeconds.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(interval);
                loading.classList.add('hidden');
                openSuccessModal();
            }
        }, 1000);
    });
});
</script>

</x-app-layout>