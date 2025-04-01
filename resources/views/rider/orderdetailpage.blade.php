@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<style>
body {
        background-color: #1a3018;
        font-family: 'Poppins', sans-serif;
    }
    </style>
<div class="container mt-4">
    <h2 class="text-center fw-bold text-white mb-4" style="background-color: black; padding: 12px; border-radius: 10px;">
        🚴‍♂️ Order #{{ $order->id }} Details
    </h2>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark">Order Information</h5>

            <p><strong>👤 Customer:</strong> <span class="fw-bold text-dark">{{ $order->user->name ?? 'Unknown' }}</span></p>
            <p><strong>📞 Contact:</strong> <span class="fw-bold text-dark">{{ $order->user->phone ?? 'No phone' }}</span></p>
            <p><strong>Total Price:</strong> <span class="fw-bold text-success">RM{{ number_format($order->total_price, 2) }}</span></p>
            <p><strong>Delivery Address:</strong> <span class="text-dark">{{ $order->delivery_address }}</span></p>
            <p><strong>Placed At:</strong> <span class="text-muted">{{ $order->placed_at->format('d M Y, H:i A') }}</span></p>
        </div>
        <div class="card-footer text-center mt-auto bg-white border-0 d-flex gap-2 p-3">
        <form action="{{ route('orders.updateStatus') }}" method="POST" class="w-50">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="status" value="confirmed">
            <input type="hidden" name="redirect_url" value="{{ route('riderstatuspage') }}">

            <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm"
                style="background-color: #1b5e20; color: white; transition: 0.3s;">
                <i class="fas fa-check-circle"></i> Accept Order
            </button>
        </form>


                        <form action="{{ route('rider.riderhomepage') }}" class="w-50">
                            @csrf
                            <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm"
                                style="background-color: #c5303e; color: white; transition: 0.3s;">
                                <i class="fas fa-times-circle"></i> Decline
                            </button>
                        </form>
                    </div>
    </div>
</div>
@endsection
