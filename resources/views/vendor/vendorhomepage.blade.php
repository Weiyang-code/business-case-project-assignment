@extends('layouts.app')
@section('title', 'Restaurant Home Page')

@section('content')

<style>
    body {
    background-color: #1a3018;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

.wrapper {
    display: flex;
}

.sidebar {
    width: 250px;
    background: #000;
    color: white;
    padding: 20px;
    min-height: 100vh; /* Full height */
}

.sidebar a {
    display: block;
    color: white;
    padding: 10px;
    margin-top: 10px;
    text-decoration: none;
    background: #1b5e20;
    border-radius: 5px;
    text-align: center;
}

.sidebar a:hover {
    background: #145214;
}

.main-content {
    flex-grow: 1; /* Take remaining space */
    padding: 20px;
}

</style>

<div class="wrapper">
    <div class="sidebar">
        <h4 class="mb-3 text-center">Customise</h4>
        <a href="{{ route('addfooditempage', ['id' => auth()->id()]) }}">Update Menu</a>
    </div>

    <div class="container-fluid mt-2 main-content">
        <div class="row">
            @foreach($orders as $order)
                <div class="col-12 pb-3">
                    <div class="card shadow-sm h-100 d-flex flex-column bg-gradient">
                        <div class="card-body flex-grow-1" style="--bs-bg-opacity: .3;">
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
                            <a href="{{ route('orderacceptpage', ['id' => $order->id]) }}" class="btn w-100" style="background-color: #1b5e20; color: white;">View Order Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
