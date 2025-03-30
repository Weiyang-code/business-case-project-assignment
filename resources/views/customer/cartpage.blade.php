@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">🛒 Your Shopping Cart</h2>

    @if($cartItems->isEmpty())
    <div class="alert alert-warning text-center">
        <p>Your cart is empty.</p>
        <a href="{{ route('menupage') }}" class="btn btn-primary">Browse Menu</a>
    </div>
    @else
    <div class="table-responsive d-none d-md-block">
        <table class="table table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr class="text-center">
                    <td>
                        <img src="{{ asset($item->menu->image) }}" width="50" class="rounded shadow-sm">
                    </td>
                    <td>{{ $item->menu->name }}</td>
                    <td>RM {{ number_format($item->menu->price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->food_id) }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control text-center w-50">
                            <button type="submit" class="btn btn-sm btn-success ms-2">✔</button>
                        </form>
                    </td>
                    <td>RM {{ number_format($item->menu->price * $item->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->food_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑 Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile View -->
    <div class="d-md-none">
        @foreach($cartItems as $item)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset($item->menu->image) }}" width="70" class="rounded me-3">
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{ $item->menu->name }}</h5>
                    <p class="mb-1 text-muted">RM {{ number_format($item->menu->price, 2) }}</p>
                    <form action="{{ route('cart.update', $item->food_id) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control text-center w-25">
                        <button type="submit" class="btn btn-sm btn-success ms-2">✔</button>
                    </form>
                    <p class="mt-2 fw-bold">Subtotal: RM {{ number_format($item->menu->price * $item->quantity, 2) }}</p>
                </div>
                <form action="{{ route('cart.remove', $item->food_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
        <a href="{{ route('menupage') }}" class="btn btn-secondary mb-2 mb-md-0">
            <i class="fas fa-arrow-left"></i> Back to Menu
        </a>

        <h4 class="fw-bold text-primary text-center">
            Total: RM {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity), 2) }}
        </h4>

        <a href="/" class="btn btn-success">
            
            Proceed to Checkout <i class="fas fa-arrow-right"></i> 
        </a>
    </div>
    @endif
</div>
@endsection