<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna dan transaksi mereka
        $users = User::with('paymentStatuses')->get();

        return view('admin.dashboard', compact('users'));
    }

    public function updatePaymentStatus(Request $request)
    {
        $paymentStatus = PaymentStatus::findOrFail($request->payment_status_id);
        $paymentStatus->status = $request->status === 'true';
        $paymentStatus->save();

        $user = $paymentStatus->user;
        $user->is_admin = $paymentStatus->status; // Set user as admin if payment status is true
        $user->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
}
