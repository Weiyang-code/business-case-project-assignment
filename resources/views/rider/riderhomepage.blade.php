@extends('layouts.app')

@section('title', 'Rider Home Page')

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold text-white mb-4" style="background-color: #101c0c; padding: 12px; border-radius: 10px;">
        🚴‍♂️ Rider Dashboard
    </h2>

    <div class="row g-4 py-3">
        @foreach($orders as $order)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100 d-flex flex-column pb-3" style="background-color: #f8f9fa;">
                <div class="card-body p-4 flex-grow-1">
                    <h5 class="fw-bold text-dark">Order #{{ $order->id }}</h5>


                    <div class="p-3 mb-3 rounded" style="background-color: #f1f3f5;">
                        <p class="mb-2"><strong>👤 Customer:</strong> <span class="fw-bold text-dark">{{ $order->user->name ?? 'Unknown' }}</span></p>
                        <p class="mb-2"><strong>📞 Contact:</strong> <span class="fw-bold text-dark">{{ $order->user->phone ?? 'No phone number' }}</span></p>
                    </div>


                    <p class="mb-2"><strong>Total Price:</strong> <span class="fw-bold" style="color: #101c0c;">RM{{ number_format($order->total_price, 2) }}</span></p>
                    <p class="mb-2"><strong>Delivery Address:</strong> <span class="text-dark">{{ $order->delivery_address }}</span></p>
                    <p class="mb-2"><strong>Payment Method:</strong> <span class="text-dark text-uppercase">{{ $order->payment_method }}</span></p>

                    <p class="mb-2"><strong>Status:</strong>
                        <span class="badge 
                @if($order->status == 'pending') bg-warning text-dark
                @elseif($order->status == 'completed') bg-success 
                @else bg-primary @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <p class="mb-3"><strong>Placed At:</strong>
                        <span class="text-muted">{{ $order->placed_at->format('d M Y, H:i A') }}</span>
                    </p>
                </div>

                <div class="card-footer text-center mt-auto bg-white border-0">
                    <a href="{{ route('orderdetailpage', ['id' => $order->id]) }}"
                        class="btn w-100 fw-bold py-2 rounded-pill shadow-sm"
                        style="background-color: #101c0c; color: white; transition: 0.3s;">
                        📦 View Pickup Details
                    </a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection