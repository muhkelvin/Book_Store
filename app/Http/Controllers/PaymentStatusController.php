<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function index()
    {
        $paymentStatuses = PaymentStatus::where('user_id', auth()->id())->with('product')->get();
        return view('payment_status.index', compact('paymentStatuses'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'proof_of_payment' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $paymentStatus = PaymentStatus::find($request->payment_status_id);

        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $path = $file->store('proof_of_payments', 'public');
            $paymentStatus->proof_of_payment = $path;
            $paymentStatus->status = false;  // Status tetap false sampai diverifikasi
            $paymentStatus->save();
        }

        return redirect()->route('payment-status.index')->with('success', 'Proof of payment uploaded successfully! Waiting for verification.');
    }
}
