@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->isEmpty())
        <p class="text-muted">You have not placed any orders yet.</p>
    @else
        <table class="table table-hover">
            <thead class="bg-light">
                <tr>
                    <th>Order ID</th>
                    <th>Total Price (RM)</th>
                    <th>Status</th>
                    <th>Placed At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="badge {{ $order->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->placed_at->format('d M Y, H:i A') }}</td>
                    <td>
                        <a href="{{ route('orders.view', ['id' => $order->id]) }}" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
