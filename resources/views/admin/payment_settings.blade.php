<x-admin-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Payment Settings</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.payment.update') }}" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div>
                <label for="payment_amount" class="block text-sm font-medium text-gray-700 mb-1">
                    Payment Amount
                </label>
                <input
                    type="number"
                    step="0.01"
                    name="payment_amount"
                    id="payment_amount"
                    value="{{ old('payment_amount', $paymentAmount->value ?? '') }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200"
                >
            </div>

            <div>
                <label for="payment_currency" class="block text-sm font-medium text-gray-700 mb-1">
                    Payment Currency (e.g., XAF, NGN, USD)
                </label>
                <input
                    type="text"
                    name="payment_currency"
                    id="payment_currency"
                    maxlength="3"
                    value="{{ old('payment_currency', $paymentCurrency->value ?? '') }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md uppercase focus:ring focus:ring-blue-200"
                >
            </div>

            <div>
                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                >
                    Update Settings
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
