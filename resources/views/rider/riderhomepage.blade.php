@extends('layouts.app')

@section('title', 'Rider Home Page')

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold text-white mb-4" style="background-color: #101c0c; padding: 12px; border-radius: 10px;">
        🚴‍♂️ Rider Dashboard
    </h2>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <h4 class="text-muted">No orders available at the moment.</h4>
        </div>
    @else
        <div class="row g-4 py-3">
            @foreach($orders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100 d-flex flex-column" style="background-color: #f8f9fa;">
                    <div class="card-body p-4 flex-grow-1">
                        <h5 class="fw-bold text-dark">Order #{{ $order->id }}</h5>

                        <div class="p-3 mb-3 rounded" style="background-color: #f1f3f5;">
                            <p class="mb-2"><strong>👤 Customer:</strong> <span class="fw-bold text-dark">{{ $order->user->name ?? 'Unknown' }}</span></p>
                            <p class="mb-2"><strong>📞 Contact:</strong> <span class="fw-bold text-dark">{{ $order->user->phone ?? 'No phone number' }}</span></p>
                        </div>

                        <p class="mb-2"><strong>Total Price:</strong> <span class="fw-bold" style="color: #101c0c;">RM{{ number_format($order->total_price, 2) }}</span></p>
                        <p class="mb-2"><strong>Delivery Address:</strong> <span class="text-dark">{{ $order->delivery_address }}</span></p>
                        <p class="mb-2"><strong>Payment Method:</strong> <span class="text-dark text-uppercase">{{ $order->payment_method }}</span></p>

                        <p class="mb-2"><strong>Placed At:</strong>
                            <span class="text-muted">{{ $order->placed_at->format('d M Y, H:i A') }}</span>
                        </p>
                    </div>

                    <div class="card-footer text-center mt-auto bg-white border-0 d-flex gap-2 p-3">
                        <form action="/" method="POST" class="w-50">
                            @csrf
                            <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm"
                                style="background-color: #28a745; color: white; transition: 0.3s;">
                                <i class="fas fa-check-circle"></i> Accept Order
                            </button>
                        </form>

                        <form action="/" method="POST" class="w-50">
                            @csrf
                            <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm"
                                style="background-color: #dc3545; color: white; transition: 0.3s;">
                                <i class="fas fa-times-circle"></i> Decline
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
