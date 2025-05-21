<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
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

                <p class="text-gray-700">Your email: <strong>{{ $user->email }}</strong></p>
                <p class="text-gray-700 mb-6">
                    Your phone: <strong>{{ $user->contact ?? 'N/A (Please update your profile)' }}</strong>
                </p>

                <form>
                    <script src="https://checkout.flutterwave.com/v3.js"></script>
                    <button type="button" onclick="makePayment()" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                        Pay Now
                    </button>

                </form>

                <script>
                    const API_publicKey = "{{ $publicKey }}";
                    const customerEmail = "{{ $user->email }}";
                    const customerPhone = "{{ $user->contact ?? '237xxxxxxxx' }}";
                    const paymentAmount = {{ $amount }};
                    const paymentCurrency = "{{ $currency }}";

                    function makePayment() {
                        FlutterwaveCheckout({
                            public_key: "{{ $publicKey }}",
                            tx_ref: "rave-{{ Str::random(12) }}-{{ $user->id }}",
                            amount: {{ $amount }},
                            currency: "{{ $currency }}",
                            payment_options: "card,ussd,banktransfer",
                            customer: {
                            email: "{{ $user->email }}",
                            phone_number: "{{ $user->contact ?? '237xxxxxxxx' }}",
                            name: "{{ $user->name }}"
                            },
                            callback: function (response) {
                            // Handle the response
                            if (response.status === "successful") {
                                window.location.href = "{{ route('payment.success') }}?tx_ref=" + response.tx_ref;
                            } else {
                                window.location.href = "{{ route('payment.failure') }}?tx_ref=" + response.tx_ref + "&status=" + response.status;
                            }
                            },
                            onclose: function() {
                            // Optional: handle modal closure
                            console.log("Payment modal closed.");
                            },
                            customizations: {
                            title: "FindIt Payment",
                            description: "Payment for found lost item.",
                            logo: "https://yourdomain.com/logo.png",
                            },
                        });
                        }

                </script>
            </div>
        </div>
    </div>
</x-app-layout>
