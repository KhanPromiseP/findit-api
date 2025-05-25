<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8 print:shadow-none print:border-none">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">INVOICE</h1>
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-700">Invoice #FAKE-{{ str_pad(Auth::id(), 4, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}</p>
                <p class="text-gray-600">Date: {{ now()->format('M d, Y') }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-200">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Billed To:</h2>
                <p class="text-gray-600 font-medium">{{ $user->name }}</p>
                <p class="text-gray-600">{{ $user->email }}</p>
                @if($user->contact)
                    <p class="text-gray-600">Phone: {{ $user->contact }}</p>
                @endif
                @if($user->address)
                    <p class="text-gray-600">Address: {{ $user->address }}</p>
                @endif
            </div>
            <div class="md:text-right">
                <h2 class="text-xl font-semibold text-gray-700 mb-3">From:</h2>
                <p class="text-gray-600 font-medium">FindIt Solutions</p>
                <p class="text-gray-600">contact@findit.com</p>
                <p class="text-gray-600">123 Main Street, Anytown, AB 12345</p>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Summary of Services:</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-50 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="px-6 py-3 border-b-2 border-gray-200">Description</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-gray-700">
                            <td class="px-6 py-4 border-b border-gray-200">Service Fee for Item Retrieval/Payment Processing</td>
                            {{-- Display the amount here --}}
                            <td class="px-6 py-4 border-b border-gray-200 text-right">
                                {{ $currency }} {{ number_format($amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="text-gray-800 bg-gray-50">
                            <td class="px-6 py-4 font-bold text-lg text-right" colspan="1">Total:</td>
                            <td class="px-6 py-4 font-bold text-lg text-right">
                                {{-- Display the total amount here --}}
                                {{ $currency }} {{ number_format($amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="mt-10 text-center text-gray-500 text-sm">
            <p>This is a simulated invoice for demonstration purposes.</p>
            <p>Thank you for using FindIt!</p>
            <p>&copy; {{ date('Y') }} FindIt. All rights reserved.</p>
        </div>

        <div class="mt-8 text-center no-print">
            <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print/Save as PDF
            </button>
            <a href="{{ url()->previous() }}" class="ml-4 text-gray-600 hover:text-gray-800">Go Back</a>
        </div>
    </div>
</body>
</html>