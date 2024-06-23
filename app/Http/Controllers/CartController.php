<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::find($request->cart_id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        $cartItem = Cart::find($request->cart_id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkout(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        foreach ($cartItems as $cartItem) {
            // Logika untuk mengatur status pembayaran, bisa disesuaikan dengan kebutuhan
            PaymentStatus::create([
                'user_id' => auth()->id(),
                'product_id' => $cartItem->product_id,
                'status' => false,
                'proof_of_payment' => null,
            ]);

            $cartItem->delete();
        }

        return redirect()->route('payment-status.index')->with('success', 'Checkout successful! Please complete your payment.');
    }
}
