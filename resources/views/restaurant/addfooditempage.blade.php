@extends('layouts.app')

@section('content')
<div class="container p-5 my-5">
    <h2 class="text-center mb-4 text-black">Add New Food Item</h2>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Add Food Form -->
    <form action="{{ route('restaurant.storefood', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Food Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-bold text-dark">Food Name</label>
            <input type="text" class="form-control border-0 shadow-sm rounded" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="form-label fw-bold text-dark">Description (optional)</label>
            <textarea class="form-control border-0 shadow-sm rounded" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="form-label fw-bold text-dark">Price (RM)</label>
            <input type="number" step="0.01" class="form-control border-0 shadow-sm rounded" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="image" class="form-label fw-bold text-dark">Image (optional)</label>
            <input type="file" class="form-control border-0 shadow-sm rounded" id="image" name="image">
        </div>

        <!-- Calories -->
        <div class="mb-4">
            <label for="calories" class="form-label fw-bold text-dark">Calories</label>
            <input type="number" step="1" class="form-control border-0 shadow-sm rounded" id="calories" name="calories" value="{{ old('calories') }}" required>
        </div>

        <!-- Vegetarian -->
        <div class="mb-4">
            <label for="vegetarian" class="form-label fw-bold text-dark">Status</label>
            <select class="form-control border-0 shadow-sm rounded" id="vegetarian" name="vegetarian" required>
                <option value="1" {{ old('vegetarian', '1') == '1' ? 'selected' : '' }}>Vegetarian</option>
                <option value="0" {{ old('vegetarian', '1') == '0' ? 'selected' : '' }}>Non-Vegetarian</option>
            </select>
        </div>

        <!-- Active/Inactive Dropdown -->
        <div class="mb-4">
            <label for="active" class="form-label fw-bold text-dark">Status</label>
            <select class="form-control border-0 shadow-sm rounded" id="active" name="active" required>
                <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Restaurant Name -->
        <div class="mb-4">
            <input type="hidden" id="restaurant" name="restaurant" value="{{ Auth::user()->id }}" required>
        </div>
        
        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg w-50">Add Food Item</button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    /* Set background color for the entire body */
    body {
        background-color: #101c0c;
    }

    /* Optional container background override */
    .container {
        background-color: #FFF9C4;
    }
</style>
@endsection
