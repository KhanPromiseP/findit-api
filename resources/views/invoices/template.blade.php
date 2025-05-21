<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoiceId }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-sm bg-gray-100 text-gray-800">
    <div class="max-w-3xl mx-auto bg-white p-6 mt-10 shadow-lg rounded-lg">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-700">Invoice</h1>
            <p class="text-sm text-gray-500">Date: {{ $date }}</p>
        </div>

        <div class="mb-8">
            <table class="w-full border-t border-b border-gray-200 divide-y divide-gray-100 text-left">
                <tbody>
                    <tr>
                        <td class="py-2 font-semibold w-1/3">Invoice ID:</td>
                        <td class="py-2">{{ $invoiceId }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Transaction Reference:</td>
                        <td class="py-2">{{ $txRef }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Customer Email:</td>
                        <td class="py-2">{{ $customerEmail }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Amount Paid:</td>
                        <td class="py-2">{{ $currency }} {{ number_format($amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-10 text-xs text-gray-600">
            <p>Thank you for your business!</p>
            <p>{{ config('app.name') }} | Your Company Address</p>
        </div>
    </div>
</body>
</html>
