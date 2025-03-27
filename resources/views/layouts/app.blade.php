<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>@yield('title', 'Default Title')</title> <!-- Title Section -->

    <style>
        .banner {
            width: 100%;
            height: 250px;
            background: url('{{ asset("food_banner.png") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .role-btn {
            flex-grow: 1;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .role-btn.active {
            background-color: #007bff;
            color: white;
        }

        .role-btn:not(.active):hover {
            background-color: #e9ecef;
        }

        .error-container {
            min-height: 50px;
        }
        
    </style>

    @yield('styles') <!-- Additional styles for child pages -->
</head>

<body class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">

    @if ($errors->any())


    <!-- Banner Section -->
    <div class="banner">
        <img src="{{ asset('food_banner.png') }}" class="banner-img">
    </div>

    <!-- Main Content Section -->


    @endif


    <div class="full-container mt-4">

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts') <!-- Additional scripts for child pages -->

</body>

</html>