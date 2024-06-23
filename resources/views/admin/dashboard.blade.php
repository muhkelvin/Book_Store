@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($users as $user)
            <div class="bg-white shadow-md rounded-lg mb-6">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
                <div class="p-4">
                    <table class="min-w-full bg-white">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Product Name</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->paymentStatuses as $status)
                            <tr>
                                <td>{{ $status->product->name }}</td>
                                <td>${{ $status->product->price }}</td>
                                <td>
                                    <form action="{{ route('admin.update.payment.status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_status_id" value="{{ $status->id }}">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="status" value="true" class="form-checkbox" onchange="this.form.submit()" {{ $status->status ? 'checked' : '' }}>
                                            <span class="ml-2">{{ $status->status ? 'Paid' : 'Unpaid' }}</span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('admin.update.payment.status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="payment_status_id" value="{{ $status->id }}">
                                        <input type="hidden" name="status" value="{{ $status->status ? 'false' : 'true' }}">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $status->status ? 'Mark as Unpaid' : 'Mark as Paid' }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
