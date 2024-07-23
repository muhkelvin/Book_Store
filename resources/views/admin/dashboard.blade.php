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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->paymentStatuses as $status)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ optional($status->product)->name }}</td>
                                <td class="py-2 px-4 border-b">${{ optional($status->product)->price }}</td>
                                <td class="py-2 px-4 border-b">
                                <span class="{{ $status->status ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $status->status ? 'Paid' : 'Unpaid' }}
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <form action="{{ route('admin.update.payment.status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="status" value="true">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Mark All as Paid</button>
                        </form>
                        <form action="{{ route('admin.update.payment.status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="status" value="false">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Mark All as Unpaid</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
