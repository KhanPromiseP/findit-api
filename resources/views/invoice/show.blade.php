<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Details') }} #{{ $payment->id }} {{-- <--- CHANGE HERE --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Invoice</h1>
                    <a href="{{ route('invoice.download', $payment->id) }}" {{-- <--- CHANGE HERE --}}
                       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l3-3m-3 3l-3-3m2.81 7H5.25a2.25 2.25 0 01-2.245-2.094L2.25 12.75V8.25a2.25 2.25 0 012.25-2.25h1.372c.516 0 .966.351 1.091.852l1.107 4.417c.423 1.684 2.053 2.766 3.738 2.766h2.529a2.25 2.25 0 002.25-2.25v-1.372c0-.516.351-.966.852-1.091l4.417-1.107c1.684-.423 2.766-2.053 2.766-3.738V7.5a2.25 2.25 0 00-2.25-2.25H15.75m-1.5 12h-2.25m-2.25 0H9m-2.25 0H5.25"></path></svg>
                        Download PDF
                    </a>
                </div>

                <hr class="my-6 border-gray-200">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Invoice To:</h2>
                        <p class="text-gray-600">{{ $user->name }}</p>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-gray-600">{{ $user->contact ?? 'N/A' }}</p>
                        <p class="text-gray-600">{{ $user->address ?? 'N/A' }}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Invoice Details:</h2>
                        <p class="text-gray-600">Invoice #{{ $payment->id }}</p> {{-- <--- CHANGE HERE --}}
                        <p class="text-gray-600">Date: {{ $payment->created_at->format('M d, Y') }}</p> {{-- <--- CHANGE HERE --}}
                        <p class="text-gray-600">Status: <span class="font-bold text-green-600">{{ ucfirst($payment->status) }}</span></p> {{-- <--- CHANGE HERE --}}
                        <p class="text-gray-600">Payment Method: {{ $payment->payment_method ?? 'N/A' }}</p> {{-- <--- CHANGE HERE --}}
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment Summary:</h2> {{-- <--- Changed from Transaction Summary --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <th class="px-6 py-3 border-b-2 border-gray-200">Description</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700">
                                    <td class="px-6 py-4 border-b border-gray-200">Payment for Item Claim</td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-right">
                                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }} {{-- <--- CHANGE HERE --}}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="text-gray-800">
                                    <td class="px-6 py-4 font-bold text-lg text-right" colspan="1">Total:</td>
                                    <td class="px-6 py-4 font-bold text-lg text-right">
                                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }} {{-- <--- CHANGE HERE --}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="mt-8 text-center text-gray-500 text-sm">
                    Thank you for your business!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>