<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PaymentSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Gate::authorize('manage-settings'); // Optional: add your policy check

        $paymentAmount = Setting::where('key', 'payment_amount')->first();
        $paymentCurrency = Setting::where('key', 'payment_currency')->first();

        return view('admin.payment_settings', compact('paymentAmount', 'paymentCurrency'));
    }

    public function update(Request $request)
    {
        // Gate::authorize('manage-settings'); // Optional: add your policy check

        $request->validate([
            'payment_amount' => 'required|numeric|min:1',
            'payment_currency' => 'required|string|size:3',
        ]);

        Setting::updateOrCreate(
            ['key' => 'payment_amount'],
            ['value' => $request->input('payment_amount')]
        );

        Setting::updateOrCreate(
            ['key' => 'payment_currency'],
            ['value' => strtoupper($request->input('payment_currency'))]
        );

        return redirect()->back()->with('success', 'Payment settings updated successfully!');
    }
}