@extends('layouts.app')

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="receipt p-4 bg-white rounded shadow-lg" style="max-width: 600px; width: 100%; border-left: 6px solid #28a745;">

        <div class="text-center mb-4">
            <h2 class="fw-bold text-success">🎉 Order Confirmed</h2>
            <p class="text-muted">Thank you for your purchase, <strong>{{ $order->user->name }}</strong>!</p>
            <p class="fw-medium">Order ID: <span class="text-primary">#{{ $order->id }}</span></p>
        </div>

        <hr>

        <h4 class="text-secondary mb-3">Order Summary</h4>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-start">Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td class="text-start">{{ $item->menu->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end fw-bold">RM {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <div class="mb-3">
            <p class="d-flex justify-content-between">
                <span>Subtotal:</span>
                <span class="fw-medium text-muted">RM {{ number_format($order->total_price - 3, 2) }}</span>
            </p>
            <p class="d-flex justify-content-between">
                <span>Delivery Fee:</span>
                <span class="fw-bold text-dark">RM 3.00</span>
            </p>
            <p class="d-flex justify-content-between fs-5 fw-bold border-top pt-2">
                <span>Total Paid:</span>
                <span class="text-success">RM {{ number_format($order->total_price, 2) }}</span>
            </p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('menupage') }}" class="btn  btn-outline-success px-5 shadow-sm">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection