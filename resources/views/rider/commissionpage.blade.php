@extends('layouts.app')

@section('title', 'Commission Page')

@section('content')
<style>
        body {
            background-color: #101c0c; /* Dark greenish background */
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
</style>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 400px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="card-body">
            <h1 class="card-title text-center">Commission Receipt</h1>
            <hr>
            <h5>Order Details</h5>
            <div class="commission-details">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p><strong>Commission Earned:</strong> RM3.00</p>
            </div>

            <a href="{{ route('rider.riderhomepage') }}" class="btn btn-primary w-100 mt-4">Home</a>
        </div>
    </div>
</div>

@endsection
   

