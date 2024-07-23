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
        $users = User::with('paymentStatuses.product')->get();

        return view('admin.dashboard', compact('users'));
    }

    public function updatePaymentStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $status = $request->status === 'true';

        // Update status pembayaran semua produk yang dibeli pengguna
        foreach ($user->paymentStatuses as $paymentStatus) {
            $paymentStatus->status = $status;
            $paymentStatus->save();
        }

        return redirect()->back()->with('success', 'All payment statuses updated successfully.');
    }
}

