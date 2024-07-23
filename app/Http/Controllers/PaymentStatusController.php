<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index()
    {
        $paymentStatuses = PaymentStatus::where('user_id', auth()->id())->with('product')->get();
        $totalAmount = $paymentStatuses->sum(fn($status) => optional($status->product)->price);

        return view('payment_status.index', compact('paymentStatuses', 'totalAmount'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'proof_of_payment' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $path = $file->store('proof_of_payments', 'public');

            PaymentStatus::where('user_id', auth()->id())
                ->where('status', 0) // Pending status
                ->update(['proof_of_payment' => $path, 'status' => 0]); // Verifying status

            return redirect()->route('payment-status.index')->with('success', 'Proof of payment uploaded successfully! Waiting for verification.');
        }

        return redirect()->route('payment-status.index')->withErrors('Failed to upload proof of payment.');
    }
}


