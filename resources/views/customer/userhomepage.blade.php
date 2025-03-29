@extends('layouts.app')
@section('title', 'Customer Home Page')

   


@section('content')
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
@endsection


@section('scripts')
@endsection