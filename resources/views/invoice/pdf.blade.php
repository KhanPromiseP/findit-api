<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $payment->id }}</title> {{-- <--- CHANGE HERE --}}
    <style>
        /* ... existing styles ... */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <img src="{{ public_path('logo/findit-logo.png') }}" alt="Your Company Logo" style="height: 50px;">
        </div>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

        <div class="details">
            <div style="width: 48%; float: left;">
                <h2>Invoice To:</h2>
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                <p>{{ $user->contact ?? 'N/A' }}</p>
                <p>{{ $user->address ?? 'N/A' }}</p>
            </div>
            <div style="width: 48%; float: right; text-align: right;">
                <h2>Invoice Details:</h2>
                <p>Invoice #: {{ $payment->id }}</p> {{-- <--- CHANGE HERE --}}
                <p>Date: {{ $payment->created_at->format('M d, Y') }}</p> {{-- <--- CHANGE HERE --}}
                <p>Status: <span class="status-paid">{{ ucfirst($payment->status) }}</span></p> {{-- <--- CHANGE HERE --}}
                <p>Payment Method: {{ $payment->payment_method ?? 'N/A' }}</p> {{-- <--- CHANGE HERE --}}
            </div>
            <div style="clear: both;"></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payment for Item Claim</td>
                    <td class="text-right">
                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }} {{-- <--- CHANGE HERE --}}
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td class="text-right">Total:</td>
                    <td class="text-right">
                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }} {{-- <--- CHANGE HERE --}}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>&copy; {{ date('Y') }} FindIt. All rights reserved.</p>
        </div>
    </div>
</body>
</html>