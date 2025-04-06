@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #1a3018;
        font-family: 'Poppins', sans-serif;
    }
</style>
<div class="container py-5">
    <h2 class="mb-4 text-white text-center fw-bold">📦 Order History</h2>

    @if($orders->where('vendor_id', '!=', auth()->id())->isEmpty())
    <div class="text-center py-5">
        <p class="text-white fs-5 opacity-75">You have not accepted any orders yet.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-hover text-center shadow rounded overflow-hidden" style="border-radius: 12px; background: white;">
            <thead class="bg-dark text-white">
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
                <tr class="align-middle">
                    <td class="fw-bold">{{ $order->id }}</td>
                    <td class="text-success fw-semibold">{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        @if($order->status == 'pending')
                        <span class="badge bg-warning text-dark">⏳ Pending</span>
                        @elseif($order->status == 'preparing')
                        <span class="badge bg-info">🍳 Preparing</span>
                        @elseif($order->status == 'assigned')
                        <span class="badge bg-primary">📌 Assigned</span>
                        @elseif($order->status == 'ready')
                        <span class="badge bg-success">✅ Ready</span>
                        @elseif($order->status == 'pickedup')
                        <span class="badge bg-secondary">🚚 Picked Up</span>
                        @elseif($order->status == 'completed')
                        <span class="badge bg-success">🎉 Completed</span>
                        @elseif($order->status == 'canceled')
                        <span class="badge bg-danger">❌ Canceled</span>
                        @else
                        <span class="badge bg-dark">❓ Unknown</span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $order->placed_at->format('d M Y, H:i A') }}</td>
                    <td>
                        <a href="{{ route('restaurant.orderacceptpage', ['id' => $order->id]) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                            🔍 View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection