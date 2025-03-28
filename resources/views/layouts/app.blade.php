<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-nav .nav-link.active {
            color: #101c0c !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            color: #101c0c;
        }

        /* ---- Desktop View ---- */
        .banner {
            background-color: #101c0c;
            min-height: 650px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 100px 5%;
            position: relative;
            color: white;
        }

        .banner-content {
            text-align: left;
            max-width: 50%;
            z-index: 2;
        }

        .banner-desc {
            font-size: 0.8rem !important;
            font-weight: 300;
            opacity: 0.7 !important;
            max-width: 500px;
            margin-top: 10px;
        }

        .banner h1 {
            font-size: 4rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .banner p {
            font-size: 1.2rem;
            line-height: 1.5;
        }

        .banner-image {
            width: auto;
            height: auto;
            max-width: 50%;
            position: absolute;
            right: 0;
            bottom: 30;
        }

        /* ---- Mobile View (Less than 768px) ---- */
        @media (max-width: 768px) {
            .banner {
                background: url("{{ asset('images/banner.jpg') }}") center/cover no-repeat;
                min-height: 600px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                text-align: left;
                padding: 100px 5%;
                position: relative;
                color: white;
            }

            .banner::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(16, 28, 12, 0.6);
            }

            .banner-content {
                position: relative;
                max-width: 100%;
                z-index: 2;
            }

            .banner h1 {
                font-size: 3rem;
            }

            .banner p {
                font-size: 1rem;
            }

            .banner-desc {
                font-size: 0.8rem !important;
                font-weight: 300;
                opacity: 0.8 !important;
            }


            .banner-image {
                display: none;
            }
        }
    </style>


</head>

<body>


    @unless(Request::is('/'))
    @include('layouts.header')
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
    @endunless

    <div>
        @yield('content')
    </div>

    @yield('scripts')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</html>