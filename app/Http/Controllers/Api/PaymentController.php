<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
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

    /**
     * Handle successful payment from Flutterwave.
     */
    public function paymentSuccess(Request $request)
    {
        $txRef = $request->query('tx_ref');

        if (!$txRef) {
            return redirect()->route('payment.failure')->with('error', 'Transaction reference missing.');
        }

        try {
            $response = $this->verifyFlutterwavePayment($txRef);

            if (
                isset($response['status'], $response['data']['status']) &&
                $response['status'] === 'success' &&
                $response['data']['status'] === 'successful'
            ) {
                // Invoice logic starts here
                try {
                    $invoiceData = [
                        'txRef' => $txRef,
                        'amount' => $response['data']['amount'],
                        'currency' => $response['data']['currency'],
                        'customerEmail' => $response['data']['customer']['email'],
                        'date' => now()->format('Y-m-d H:i:s'),
                        'invoiceId' => 'INV-' . time(),
                    ];

                    // Generate PDF from Blade view
                    $pdf = \PDF::loadView('invoices.template', $invoiceData);

                    $invoiceFileName = 'invoice_' . $invoiceData['invoiceId'] . '.pdf';
                    $invoicePath = storage_path('app/invoices/' . $invoiceFileName);

                    // Ensure invoices directory exists
                    if (!\File::isDirectory(dirname($invoicePath))) {
                        \File::makeDirectory(dirname($invoicePath), 0755, true, true);
                    }

                    $pdf->save($invoicePath);

                    // Save invoice to database
                    \App\Models\Invoice::create([
                        'user_id' => Auth::id(),
                        'order_id' => $response['data']['tx_ref'] ?? null,
                        'invoice_id' => $invoiceData['invoiceId'],
                        'file_path' => 'invoices/' . $invoiceFileName,
                        'amount' => $invoiceData['amount'],
                        'currency' => $invoiceData['currency'],
                        'status' => 'generated',
                    ]);

                    $invoiceId = $invoiceData['invoiceId'];

                } catch (\Exception $e) {
                    Log::error("Invoice Generation Error: " . $e->getMessage());
                    $invoiceId = 'error';
                    return view('payment.success', compact('txRef', 'response', 'invoiceId'))
                        ->with('warning', 'Payment was successful, but invoice generation failed. Please contact support.');
                }

                return view('payment.success', compact('txRef', 'response', 'invoiceId'));
            }

            return redirect()->route('payment.failure')
                ->with('error', 'Payment verification failed: ' . ($response['message'] ?? 'Unknown error.'));

        } catch (\Exception $e) {
            Log::error('Payment verification error: ' . $e->getMessage(), ['tx_ref' => $txRef]);
            return redirect()->route('payment.failure')->with('error', 'An error occurred. Please try again later.');
        }
    }


    /**
     * Handle failed payment or verification error.
     */
    public function paymentFailure(Request $request)
    {
        $txRef = $request->query('tx_ref');
        $status = $request->query('status');
        $message = $request->session()->get('error', 'Your payment could not be processed.');

        return view('payment.failure', compact('txRef', 'status', 'message'));
    }

    /**
     * Allow user to download their invoice.
     */
    public function downloadInvoice($invoiceId)
    {
        // Replace with real logic in production
        $filePath = storage_path("app/invoices/invoice_{$invoiceId}.pdf");

        if (!file_exists($filePath)) {
            abort(404, 'Invoice not found.');
        }

        return response()->download($filePath, "invoice_{$invoiceId}.pdf");
    }

    /**
     * Private method to verify payment via Flutterwave API.
     */
    private function verifyFlutterwavePayment($txRef)
    {
        $secretKey = config('services.flutterwave.secret_key');
        $url = "https://api.flutterwave.com/v3/transactions/verify_by_reference?tx_ref={$txRef}";

        $response = Http::withToken($secretKey)
            ->acceptJson()
            ->get($url);

        return $response->json();
    }
}