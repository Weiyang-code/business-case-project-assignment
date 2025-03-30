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
                        <p class="text-primary"><strong>Price: RM{{ number_format($menu->price, 2) }}</strong></p>

                        <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                            @csrf
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
@endsection