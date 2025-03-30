@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-header text-white text-center" style="background-color: #101c0c;">
                    <h2 class="mb-0">Checkout</h2>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price (RM)</th>
                                <th>Total (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->menu->price, 2) }}</td>
                                <td>{{ number_format($item->menu->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="border-top pt-3 mt-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-end fw-semibold">Subtotal:</td>
                                    <td class="text-end">RM {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity), 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-end fw-semibold">Delivery Fee:</td>
                                    <td class="text-end">RM 3.00</td>
                                </tr>
                                <tr class="border-top">
                                    <td class="text-end fw-bold text-success fs-5">Total:</td>
                                    <td class="text-end fw-bold text-success fs-5">RM {{ number_format($cartItems->sum(fn($item) => $item->menu->price * $item->quantity) + 3, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4">
                        @csrf

                        <div class="mb-3">
                            <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                            <small class="text-muted d-block mb-1">* Currently, we only accept Cash on Delivery (COD)</small>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="cash">Cash</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="delivery_address" class="form-label fw-bold">Select Delivery Block</label>
                            <select name="delivery_address" id="delivery_address" class="form-select" required>
                                <option value="" disabled selected>-- Select Your Block --</option>
                                <option value="Block A">UCSI University - Block A</option>
                                <option value="Block B">UCSI University - Block B</option>
                                <option value="Block C">UCSI University - Block C</option>
                                <option value="Block D">UCSI University - Block D</option>
                                <option value="Block G">UCSI University - Block G</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold">Additional Notes (Optional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="2" placeholder="Any special instructions?"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-shopping-cart"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('cart.view') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Cart
                </a>
            </div>
        </div>
    </div>
</div>
@endsection