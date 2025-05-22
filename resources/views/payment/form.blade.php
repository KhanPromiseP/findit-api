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
                <p class="text-gray-700">Your email: <strong>{{ $user->email }}</strong></p>
                <p class="text-gray-700 mb-6">
                    Your phone: <strong>{{ $user->contact ?? 'N/A (Please update your profile)' }}</strong>
                </p>

                <div id="payment-loading" class="hidden text-center text-indigo-600 font-medium my-4">
                    Processing payment...
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

   

<script src="https://checkout.flutterwave.com/v3.js" onload="window.flutterwaveReady = true;"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const API_publicKey = "{{ config('flutterwave.public_key') }}";
    const payNowButton = document.getElementById('payNowButton');
    const loading = document.getElementById('payment-loading');
    const error = document.getElementById('payment-error');

    const customerEmail = "{{ $user->email }}";
    const customerPhone = "{{ $user->contact ?? '' }}";
    const customerName = "{{ $user->name }}";
    const paymentAmount = parseFloat({{ $amount }});
    const paymentCurrency = "{{ $currency }}";

    payNowButton.addEventListener('click', function () {
        if (!window.flutterwaveReady) {
            alert('Payment system not ready. Please wait.');
            return;
        }

        const txRef = "findit-{{ now()->timestamp }}-{{ $user->id }}-" + Math.floor(Math.random() * 1000000);

        loading.classList.remove('hidden');
        error.classList.add('hidden');
        payNowButton.disabled = true;

        try {
            FlutterwaveCheckout({
                public_key: API_publicKey,
                tx_ref: txRef,
                amount: paymentAmount,
                currency: paymentCurrency,
                customer: {
                    email: customerEmail,
                    phone_number: customerPhone,
                    name: customerName
                },
                callback: function (response) {
                    window.location.href = "{{ route('payment.success') }}?tx_ref=" + response.tx_ref;
                },
                onclose: function () {
                    loading.classList.add('hidden');
                    payNowButton.disabled = false;
                },
                customizations: {
                    title: "FindIt Payment",
                    description: "Payment for found lost item.",
                    logo: "{{ asset('logo/findit-logo.png') }}"
                }
            });
        } catch (e) {
            console.error("FlutterwaveCheckout failed:", e);
            loading.classList.add('hidden');
            payNowButton.disabled = false;
            error.classList.remove('hidden');
            error.textContent = "Failed to open payment: " + e.message;
        }
    });
});
</script>

</x-app-layout>
