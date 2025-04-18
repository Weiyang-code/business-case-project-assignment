@extends('layouts.app')

@section('content')
<div class="container p-5 my-5">
    <h2 class="text-center mb-4 text-black">Edit Food Item</h2>

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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Menu Item</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('restaurant.updatefood', ['id' => $menu->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Food item name -->
                <div class="form-group mb-3">
                    <label for="name">Food Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name) }}">
                </div>

                <!-- Food item description -->
                <div class="form-group mb-3">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control">{{ old('description', $menu->description) }}</textarea>
                </div>

                <!-- Food item price -->
                <div class="form-group mb-3">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price) }}">
                </div>

                <!-- Food item image -->
                <div class="form-group mb-3">
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <!-- Food calories -->
                <div class="form-group mb-3">
                    <label for="calories">Calories:</label>
                    <input type="number" name="calories" class="form-control" value="{{ old('calories', $menu->calories) }}">
                </div>

                <!-- Active/Inactive Dropdown -->
                <div class="form-group mb-3">
                    <label for="vegetarian">Vegetarian:</label>
                    <select name="vegetarian" class="form-control">
                        <option value="1" {{ old('vegetarian', $menu->vegetarian) == '1' ? 'selected' : '' }}>Vegetarian</option>
                        <option value="0" {{ old('vegetarian', $menu->vegetarian) == '0' ? 'selected' : '' }}>Non-Vegetarian</option>
                    </select>
                </div>

                <!-- Active/Inactive Dropdown -->
                <div class="form-group mb-3">
                    <label for="active">Status:</label>
                    <select name="active" class="form-control">
                        <option value="1" {{ old('active', $menu->active) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('active', $menu->active) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Food Item</button>
            </form>
        </div>
    </div>
</div>
@endsection
