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
        width: 100%;
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

    /* Line Connector (Now properly aligned) */
    .connector {
        position: absolute;
        top: 35px; /* Centers the line with the circle */
        left: 50%;
        width: 100%;
        height: 1px;
        background: transparent;
        border-top: 1.5px dashed white; /* Reduced thickness */
        z-index: 1;
    }


    /* Make sure the last status does not have a connector */
    .status-container:last-child .connector {
        display: none;
    }

    /* Adjust connector width to fit correctly */
    .timeline .status-container:not(:last-child) .connector {
        width: calc(100% - 70px); /* Adjust based on circle size */
        left: 50%;
        transform: translateX(35px); /* Move the line correctly */
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
            <div class="status-text">Runner Assigned</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'ready' ? 'active' : '' }}">3</div>
            <div class="connector"></div>
            <div class="status-text">Order Prepared</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'pickedup' ? 'active' : '' }}">4</div>
            <div class="connector"></div>
            <div class="status-text">Runner Picked Up</div>
        </div>
        <div class="status-container">
            <div class="status-step {{ $order->status == 'completed' ? 'active' : '' }}">5</div>
            <div class="status-text">Order Delivered</div>
        </div>
    </div>

    @if ($order->status == 'ready')
        <div class="d-flex justify-content-center mt-4">
            <form action="{{ route('orders.updateStatus') }}" method="POST" class="w-50">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="status" value="pickedup">
                <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm bg-success text-white">
                    <i class="fas fa-check-circle"></i> Order Picked Up
                </button>
            </form>
        </div>
    @endif

    @if ($order->status == 'pickedup')
        <div class="d-flex justify-content-center mt-4">
            <form action="{{ route('orders.updateStatus') }}" method="POST" class="w-50">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="status" value="completed">
                <button type="submit" class="btn w-100 fw-bold py-2 rounded-pill shadow-sm bg-success text-white">
                    <i class="fas fa-check-circle"></i> Order Delivered
                </button>
            </form>
        </div>
    @endif

    @if ($order->status == 'completed')
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('commissionpage' , ['id' => $order->id]) }}" class="btn w-50 fw-bold py-2 rounded-pill shadow-sm btn-primary">
                <i class="fas fa-file-invoice-dollar"></i> View Commission
            </a>
        </div>
    @endif
</div>

@endsection
