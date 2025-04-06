@extends('layouts.app')

@section('content')
<div class="container p-5 my-5">
    <h2 class="text-center mb-4 text-black font-weight-bold">Your Menu</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Menu Cards -->
    <div class="row">
        @foreach ($menus as $menu)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-light rounded">
                <img src="{{ asset($menu->image) }}" class="card-img-top rounded-top" alt="{{ $menu->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-black">{{ $menu->name }}</h5>
                    <p class="card-text text-muted">{{ $menu->description }}</p>
                    <p class="card-text text-success"><strong>Price:</strong> RM{{ number_format($menu->price, 2) }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('restaurant.editfood', ['id' => $menu->id]) }}" class="btn btn-custom btn-sm">Update Menu</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .btn-custom {
        background-color: #101c0c; /* Dark green */
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #2a3a28; /* A slightly lighter shade on hover */
        color: white;
    }
</style>
@endsection
