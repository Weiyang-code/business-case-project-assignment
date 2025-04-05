@extends('layouts.app')
@section('title', 'Runner Home Page')

@section('content')

<style>
    body {
        background-color: #1a3018;
        font-family: 'Poppins', sans-serif;
    }
    
    /* Sticky Bottom Tab */
    .sticky-bottom-tab {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 10px;
        box-shadow: 0px -2px 10px rgba(255, 255, 255, 0.2);
        z-index: 1000;
    }

    .order-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .order-btn {
        background-color: #1b5e20;
        color: white;
        border: none;
        padding: 8px;
        border-radius: 5px;
        width: 100%;
        text-align: center;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">
        @php
            $preparingOrders = $orders->where('status', 'preparing');
            $acceptedOrders = $orders->whereNotIn('status', ['preparing', 'canceled', 'completed'])
                         ->where('rider_id', auth()->id());
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
                            <a href="{{ route('runner.orderdetailpage', ['id' => $order->id]) }}" class="btn w-100" style="background-color: #1b5e20; color: white;">View Pickup Details</a>
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

@if($acceptedOrders->count() > 0)
    <!-- Bootstrap Modal for Redirect Alert -->
    <div class="modal fade" id="redirectModal" tabindex="-1" aria-labelledby="redirectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.8); color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="redirectModalLabel">Orders Already Accepted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have active pickup requests in progress. Click below to view the status of each order.
                </div>
                <div class="modal-footer d-flex flex-column w-100">
                    @foreach($acceptedOrders as $order)
                        <a href="{{ route('runnerstatuspage', ['id' => $order->id]) }}" class="btn btn-success w-100 mb-2">
                            View Pickup Request #{{ $order->id }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Tab for Ongoing Orders -->
    <div class="sticky-bottom-tab">
        <h6 class="text-center mb-2">Ongoing Pickup Requests</h6>
        <div class="order-list">
            @foreach($acceptedOrders as $order)
                <a href="{{ route('runnerstatuspage', ['id' => $order->id]) }}" class="order-btn mb-2 d-block">
                    Pickup Request #{{ $order->id }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- JavaScript to Trigger Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var redirectModal = new bootstrap.Modal(document.getElementById('redirectModal'));
            redirectModal.show();
        });
    </script>
@endif

@endsection
