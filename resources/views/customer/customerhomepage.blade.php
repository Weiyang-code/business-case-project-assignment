@extends('layouts.app')
@section('title', 'Customer Home Page')




@section('content')
<!-- Banner Section -->
<section class="banner">
    <div class="banner-content">
        <p>Bringing Warm Meals, Closer to You</p>
        <h1>Care Bites</h1>
        <p class="banner-desc">
            A place where every bite feels like home. Care Bites is all about delivering wholesome,
            heartwarming meals made with love. Whether you're looking for a comforting dish or a nutritious feast,
            we bring fresh, delicious flavors straight to your table. Simple, warm, and made just for you.
        </p>
    </div>
    <img src="{{ asset('images/banner.jpg') }}" alt="Dining Image" class="banner-image">
</section>

<!-- Restaurant Section -->
<section class="restaurant-section container mt-5 pb-5">
    <h2 class="text-center mb-4">Choose Your Restaurant</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="{{ asset('images/mealbox.jpg') }}" class="card-img-top" alt="Restaurant Image">
                <div class="card-body text-center">
                    <h4 class="card-title">Another Mealbox</h4>
                    <p class="card-text">Fresh, Balanced, and Different Every Day!</p>
                    <a href="{{route ('menupage')}}" class="btn-menu">See Menu</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
@endsection