@extends('layouts.app')
@section('title', 'Rider Home Page')

@section('content')

<style>
    body {
        background-color: #1a3018;
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="container-fluid mt-4">
<div class="row">
    @php
        $preparingOrders = $orders->where('status', 'preparing');
    @endphp
    
    @if($preparingOrders->count() > 0)
        @foreach($preparingOrders as $order)
        <div class="col-12 pb-3"> <!-- Each card takes full width -->
    <div class="card shadow-sm h-100 d-flex flex-column" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="card-body flex-grow-1 text-white">
            <h5 class="card-title">Order ID: {{ $order->id }}</h5>
            <p class="card-text">
                <strong>Total Price:</strong> 
                <span class="text-success">RM{{ number_format($order->total_price, 2) }}</span>
            </p>
            <p class="card-text">
                <strong>Status:</strong> 
                <span class="badge bg-primary">{{ ucfirst($order->status) }}</span>
            </p>
            <p class="card-text">
                <strong>Placed At:</strong> 
                <span class="text-white">{{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y, H:i A') }}</span>
            </p>
        </div>
        <div class="card-footer bg-transparent border-0 text-center mt-auto mb-2">
            <a href="{{ route('rider.orderdetailpage', ['id' => $order->id]) }}" class="btn w-100" style="background-color: #1b5e20; color: white;">View Pickup Details</a>
        </div>
    </div>
</div>

        @endforeach
    @else
    <div class="col-12 text-center py-5">
    <h2 class="text-white opacity-75">No orders available currently</h2>
    </div>
    @endif
</div>
</div>



@endsection
