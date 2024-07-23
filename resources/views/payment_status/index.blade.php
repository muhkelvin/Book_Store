@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Payment Status</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 border-b">Product Name</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 border-b">Price</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 border-b">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($paymentStatuses as $status)
                    <tr class="hover:bg-gray-100">
                        <td class="py-4 px-6 border-b text-gray-600">{{ optional($status->product)->name }}</td>
                        <td class="py-4 px-6 border-b text-gray-600">${{ optional($status->product)->price }}</td>
                        <td class="py-4 px-6 border-b text-gray-600">
                            @if ($status->proof_of_payment)
                                @if ($status->status)
                                    <span class="text-green-500 font-semibold">Success</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">Verifying Payment</span>
                                @endif
                            @else
                                <span class="text-red-500 font-semibold">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Upload Proof of Payment</h2>
            <div class="mb-4">
                <p class="text-gray-700 text-sm font-bold mb-2">Total Amount: ${{ $totalAmount }}</p>
            </div>
            <form action="{{ route('payment-status.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="proof_of_payment" class="block text-gray-700 text-sm font-bold mb-2">Select File</label>
                    <input type="file" name="proof_of_payment" id="proof_of_payment" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Upload Proof</button>
                </div>
            </form>
        </div>
    </div>
@endsection
