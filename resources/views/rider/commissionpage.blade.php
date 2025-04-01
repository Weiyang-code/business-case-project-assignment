@extends('layouts.app')

@section('title', 'Commission Page')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="commission-box">
            <h1>Commission Receipt</h1>
            <hr>
            <h5>Order Details</h5>
            <div class="commission-details">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p><strong>Order Amount:</strong> ${{ number_format($order->amount, 2) }}</p>
                <p><strong>Commission Earned:</strong> ${{ number_format($order->commission, 2) }}</p>
            </div>

            <a href="{{ route('rider.riderhomepage') }}" class="btn btn-primary home-btn">Home</a>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .commission-box {
            width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .commission-box hr {
            margin: 10px 0;
        }
        .commission-details {
            text-align: left;
            margin-top: 10px;
        }
        .commission-details p {
            margin-bottom: 8px;
            font-size: 16px;
        }
        .commission-details strong {
            display: inline-block;
            width: 150px; /* Keeps all labels aligned */
        }
        .home-btn {
            margin-top: 20px;
            width: 100%;
        }
    </style>
@endsection