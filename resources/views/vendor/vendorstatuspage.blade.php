@extends('layouts.app')

@section('title', 'Order Status')

@section('content')
<style>
    body {
        background-color: #1a3018;
        font-family: 'Poppins', sans-serif;
    }
    .timeline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        position: relative;
    }
    .status-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
    }
    .status-step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        font-size: 18px;
        font-weight: bold;
        color: white;
        background-color: gray;
        opacity: 0.6;
        transition: background-color 0.3s, opacity 0.3s;
        z-index: 2;
    }
    .active {
        background-color: blue;
        opacity: 1;
    }
    .status-text {
        text-align: center;
        color: white;
        font-size: 14px;
        margin-top: 10px;
        opacity: 0.6;
        transition: opacity 0.3s;
    }
    .active + .status-text {
        opacity: 1;
    }
    /* Dotted Line Connector */
    .connector {
        position: absolute;
        top: 35px;
        left: 50%;
        width: 100%;
        height: 1px;
        background: transparent;
        border-top: 1.5px dashed white;
        z-index: 1;
    }
    .status-container:last-child .connector {
        display: none;
    }
    .timeline .status-container:not(:last-child) .connector {
        width: calc(100% - 70px);
        left: 50%;
        transform: translateX(35px);
    }
</style>

<div class="container mt-4">
    <h2 class="text-center fw-bold text-white mb-4 p-3 bg-black rounded">
        🚴‍♂️ Order #{{ $order->id }} Status Timeline 
    </h2>
    
    <div class="timeline">
        <div class="status-container">
            <div class="status-step {{ $order->status == 'preparing' ? 'active' : '' }}">1</div>
            <div class="connector"></div>
            <div class="status-text">Preparing Food</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'assigned' ? 'active' : '' }}">2</div>
            <div class="connector"></div>
            <div class="status-text">Rider Assigned</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'ready' ? 'active' : '' }}">3</div>
            <div class="connector"></div>
            <div class="status-text">Order Prepared</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'pickedup' ? 'active' : '' }}">4</div>
            <div class="status-text">Rider Picked Up</div>
        </div>
    </div>

    @if ($order->status == 'assigned')
        <div class="d-flex justify-content-center mt-4">
            <form action="{{ route('orders.updateStatus') }}" method="POST" class="w-50">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="status" value="ready">
                <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm bg-success text-white">
                    <i class="fas fa-check-circle"></i> Order Prepared
                </button>
            </form>
        </div>
    @endif

    @if ($order->status == 'pickedup')
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('vendor.vendorhomepage') }}" class="btn w-50 fw-bold py-2 rounded-pill shadow-sm btn-primary">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    @endif
</div>
@endsection
