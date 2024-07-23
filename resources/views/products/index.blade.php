@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4">
                        <h5 class="text-lg font-bold">{{ $product->name }}</h5>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-gray-800 font-semibold">${{ $product->price }}</p>
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-blue-500 text-black py-2 rounded">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
