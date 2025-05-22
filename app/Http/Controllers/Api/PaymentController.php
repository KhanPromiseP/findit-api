<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protect all routes
    }

    /**
     * Display the payment form with Flutterwave key and amount settings.
     */
    public function showPaymentForm()
    {
        $publicKey = config('services.flutterwave.public_key');
        $amount = Setting::where('key', 'payment_amount')->value('value') ?? 0;
        $currency = Setting::where('key', 'payment_currency')->value('value') ?? 'XAF';
        $user = Auth::user();

        return view('payment.form', compact('publicKey', 'amount', 'currency', 'user'));
    }



    // Handle Flutterwave callback (server-side verification)
    public function handleCallback(Request $request)
    {
        // Verify this is a legitimate Flutterwave callback
        if (!$request->has('tx_ref') || !$request->has('transaction_id') || !$request->has('status')) {
            return $this->failedPayment($request, 'Invalid callback parameters');
        }

        $transactionId = $request->transaction_id;
        $txRef = $request->tx_ref;
        $status = $request->status;

        // Check if we've already processed this transaction
        $existingPayment = Payment::where('transaction_id', $transactionId)->first();
        if ($existingPayment) {
            return $this->processExistingPayment($existingPayment);
        }

        // Verify transaction with Flutterwave API
        $verificationResponse = $this->verifyTransaction($transactionId);
        
        if (!$verificationResponse->successful()) {
            return $this->failedPayment($request, 'Failed to verify transaction with Flutterwave');
        }

        $verificationData = $verificationResponse->json();
        
        if ($verificationData['status'] !== 'success' || $verificationData['data']['status'] !== 'successful') {
            return $this->failedPayment($request, 'Transaction not successful on Flutterwave');
        }

        // Extract relevant data
        $paymentData = $verificationData['data'];
        $amount = $paymentData['amount'];
        $currency = $paymentData['currency'];
        $customerEmail = $paymentData['customer']['email'];
        
        // Find user (you might want to use tx_ref to match with your user)
        $userId = $this->extractUserIdFromTxRef($txRef);
        $user = User::find($userId);

        if (!$user) {
            return $this->failedPayment($request, 'User not found');
        }

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'transaction_id' => $transactionId,
            'tx_ref' => $txRef,
            'amount' => $amount,
            'currency' => $currency,
            'status' => 'successful',
            'payment_method' => $paymentData['payment_type'] ?? 'unknown',
            'customer_email' => $customerEmail,
            'metadata' => json_encode($paymentData),
            'verified_at' => now(),
        ]);

        // TODO: Add your business logic here (e.g., grant access, send email, etc.)

        return $this->successfulPayment($payment);
    }

    // Handle successful payment
    protected function successfulPayment(Payment $payment)
    {
        // You might want to redirect to a success page with payment details
        return redirect()->route('payment.success')
            ->with('success', 'Payment verified successfully')
            ->with('payment', $payment);
    }

    // Handle failed payment
    protected function failedPayment(Request $request, string $reason)
    {
        // Log the failure
        \Log::error("Payment verification failed: {$reason}", $request->all());

        // Create a failed payment record if you want to track failures
        if ($request->has('tx_ref') && $request->has('transaction_id')) {
            Payment::create([
                'transaction_id' => $request->transaction_id,
                'tx_ref' => $request->tx_ref,
                'status' => 'failed',
                'failure_reason' => $reason,
                'metadata' => json_encode($request->all()),
            ]);
        }

        return redirect()->route('payment.failure')
            ->with('error', 'Payment verification failed: ' . $reason);
    }

    // Verify transaction with Flutterwave API
    protected function verifyTransaction(string $transactionId)
    {
        $secretKey = config('services.flutterwave.secret_key');

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->get("https://api.flutterwave.com/v3/transactions/{$transactionId}/verify");
    }

    // Extract user ID from transaction reference
    protected function extractUserIdFromTxRef(string $txRef)
    {
        // Assuming your tx_ref format is "rave-[random]-[user_id]"
        $parts = explode('-', $txRef);
        return end($parts);
    }

    // Handle existing payment
    protected function processExistingPayment(Payment $payment)
    {
        if ($payment->status === 'successful') {
            return $this->successfulPayment($payment);
        }

        return $this->failedPayment(request(), 'Payment was previously recorded as failed');
    }

    // Success page (frontend)
    public function paymentSuccess()
    {
        if (!session()->has('success')) {
            return redirect()->route('home');
        }

        return view('payment.success', [
            'payment' => session('payment'),
        ]);
    }



    public function initiatePayment(Request $request)
{
    $validated = $request->validate([
        'tx_ref' => 'required|string',
        'amount' => 'required|numeric',
        'currency' => 'required|string|size:3',
        'user_id' => 'required|exists:users,id'
    ]);

    // Create a pending payment record
    $payment = Payment::create([
        'user_id' => $validated['user_id'],
        'tx_ref' => $validated['tx_ref'],
        'amount' => $validated['amount'],
        'currency' => $validated['currency'],
        'status' => 'pending',
    ]);

    return response()->json(['success' => true, 'payment_id' => $payment->id]);
}

public function processing(Request $request)
{
    // Show a processing page that polls the server for verification completion
    return view('payment.processing', [
        'tx_ref' => $request->tx_ref,
        'transaction_id' => $request->transaction_id,
        'user_id' => $request->user_id
    ]);
}

    // Failure page (frontend)
    public function paymentFailure()
    {
        return view('payment.failure', [
            'error' => session('error', 'Unknown payment error'),
        ]);
    }
}