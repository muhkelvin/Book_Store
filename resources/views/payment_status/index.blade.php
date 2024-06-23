@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Payment Status</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($paymentStatuses as $status)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ optional($status->product)->name }}</td>
                        <td class="py-2 px-4 border-b">${{ optional($status->product)->price }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($status->proof_of_payment)
                                @if ($status->status)
                                    Success
                                @else
                                    Verifying Payment
                                @endif
                            @else
                                <a href="{{ route('payment-status.upload') }}" class="text-blue-500">Submit Proof</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Upload Proof of Payment</h2>
            <form action="{{ route('payment-status.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_status_id" value="{{ $paymentStatuses->first()->id }}">
                <input type="file" name="proof_of_payment" class="mb-4 block w-full">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload Proof</button>
            </form>
        </div>
    </div>
@endsection
