@extends('layouts.app')
@section('title', 'Customer Home Page')


@section('content')
<!-- Banner Section -->
<section class="menu-banner">
    <div class="menu-banner-content">
        <h1>Another Mealbox</h1>
        <p>We're ready to deliver delicious mealboxes straight to your doorstep—crafted with love, packed with goodness</p><br>
        <a href="{{ route('menupage') }}" class="btn btn-light">See Menu</a>
    </div>
</section>

<!-- Success Message Alert -->
@if(session('success'))
<div class="container p-5">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif


<!-- Menu Section -->
<section class="menu py-5">
    <div class="container">
        <h2 class="text-center mb-4">Our Menu</h2>
        <div class="row">
            @foreach($menuItems as $menu)
            <div class="col-md-4 pb-3">
                <div class="card p-3">
                    <img src="{{ asset($menu->image) }}" class="card-img-top img-fixed p-1" alt="{{ $menu->name }}">
                    <div class="card-body">
                        <h4>{{ $menu->name }}</h4>
                        <p class="text-muted">{{ $menu->description }}</p>
                        <p class="text-price"><strong>Price: RM{{ number_format($menu->price, 2) }}</strong></p>

                        <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-outline-secondary quantity-decrease">-</button>
                                <input type="number" name="quantity" class="form-control text-center quantity-input" value="1" min="1">
                                <button type="button" class="btn btn-outline-secondary quantity-increase">+</button>
                            </div>
                            <button type="submit" class="btn-cart w-100">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.quantity-decrease').forEach(button => {
            button.addEventListener('click', function() {
                let input = this.nextElementSibling;
                if (input.value > 1) {
                    input.value--;
                }
            });
        });

        document.querySelectorAll('.quantity-increase').forEach(button => {
            button.addEventListener('click', function() {
                let input = this.previousElementSibling;
                input.value++;
            });
        });
    });
</script>
@endsection