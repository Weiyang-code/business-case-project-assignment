@extends('layouts.app')
@section('title', 'Rider Home Page')

@section('content')

<div class="container-fluid mt-4">
    <div class="row">
        @foreach($orders as $order)
            <div class="col-12 pb-3"> <!-- Each card takes full width -->
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-body flex-grow-1">
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
                            <span class="text-muted">{{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y, H:i A') }}</span>
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 text-center mt-auto">
                        <a href="{{ route('orderdetailpage') }}" class="btn btn-primary w-100">View Pickup Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



@endsection
