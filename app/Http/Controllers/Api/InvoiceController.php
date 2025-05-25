<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Payment; 
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
   
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

 
    public function show(Payment $payment) 
    {
        // Ensuring the authenticated user owns this payment
        if (Auth::id() !== $payment->user_id) {
            abort(403, 'Unauthorized action.'); 
        }

        $user = $payment->user; 

        return view('invoice.show', compact('payment', 'user')); 
    }

 
    public function download(Payment $payment) 
    {
        // Ensuring the authenticated user owns this payment
        if (Auth::id() !== $payment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $user = $payment->user;

        // Load the view with data
        $pdf = Pdf::loadView('invoice.pdf', compact('payment', 'user')); // <--- PASS 'payment' INSTEAD OF 'transaction'

        // You can stream it or download it directly
        // return $pdf->stream('invoice-' . $payment->id . '.pdf'); // Opens in browser
        return $pdf->download('invoice-' . $payment->id . '.pdf'); 
    }

    /**
     * Display a fake invoice page with user details and dynamic amount/currency.
     *
     * @return \Illuminate\View\View
     */
    public function fakeDownload()
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Fetch payment amount and currency from settings
        $paymentAmountSetting = Setting::where('key', 'payment_amount')->first();
        $paymentCurrencySetting = Setting::where('key', 'payment_currency')->first();

        // Get the value, or set a default if not found
        $amount = $paymentAmountSetting ? (float)$paymentAmountSetting->value : 0.00;
        $currency = $paymentCurrencySetting ? $paymentCurrencySetting->value : 'XAF'; // Default to XAF or USD

        return view('invoice.fake_invoice', compact('user', 'amount', 'currency'));
    }
}