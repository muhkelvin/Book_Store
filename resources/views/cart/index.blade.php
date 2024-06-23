@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Your Cart</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Total</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item->product->name }}</td>
                        <td class="py-2 px-4 border-b">${{ $item->product->price }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-16 text-center border rounded">
                                <button type="submit" style="background-color: #38a169; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; margin-left: 0.5rem;">Update</button>
                            </form>
                        </td>
                        <td class="py-2 px-4 border-b">${{ $item->product->price * $item->quantity }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('cart.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <button type="submit" style="background-color: #ed8936; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" style="background-color: #38a169; color: white; padding: 0.75rem 1rem; border-radius: 0.375rem;">Proceed to Checkout</button>
            </form>
        </div>
    </div>
@endsection
