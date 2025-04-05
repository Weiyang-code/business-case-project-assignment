@extends('layouts.app')
@section('title', 'Login Page')

@section('content')
<style>
    body {
        background-color: #101c0c;
        font-family: 'Poppins', sans-serif;
    }
    .card {
        border-radius: 15px;
        background: #fff;
        padding: 2rem;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
    .role-btn {
        transition: all 0.3s ease-in-out;
        color: #101c0c;
        font-weight: 600;
    }
    .role-btn.active, .role-btn:hover {
        background: #101c0c !important;
        color: #fff !important;
    }
    .btn-primary {
        background-color: #101c0c;
        border: none;
    }
    .btn-primary:hover {
        background-color: #162711;
    }
    .form-control {
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #101c0c;
        box-shadow: 0px 0px 8px rgba(16, 28, 12, 0.5);
    }
    a {
        color: #101c0c;
        font-weight: 500;
    }
    a:hover {
        text-decoration: underline;
        color: #162711;
    }
</style>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 420px;">
        <div class="text-center">
            <img src="{{ asset('images/food_app_logo.png') }}" alt="Logo" class="mb-3" style="width: 90px;">
        </div>

        <h3 class="text-center mb-4" style="font-weight: 700; color: #101c0c;">Login to Your Account</h3>

        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn role-btn active rounded-pill px-4" data-role="User" onclick="setRole(this)">Customer</button>
            <button type="button" class="btn role-btn rounded-pill px-4" data-role="Vendor" onclick="setRole(this)">Restaurant</button>
            <button type="button" class="btn role-btn rounded-pill px-4" data-role="Rider" onclick="setRole(this)">Runner</button>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill shadow-sm">Login</button>

            <div class="text-center mt-3">
                <a href="#">Forgot Password?</a>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="btn btn-outline-dark w-100 py-2 rounded-pill shadow-sm">Register</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('get-role') }}")
            .then(response => response.json())
            .then(data => {
                if (!data.role) {
                    setRole(document.querySelector('.role-btn[data-role="User"]'));
                }
            })
            .catch(error => console.error("Error fetching role:", error));
    });

    function setRole(button) {
        document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active', 'btn-primary'));
        button.classList.add('active', 'btn-primary');

        const selectedRole = button.getAttribute('data-role');

        fetch("{{ route('set-role') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    role: selectedRole
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
@endsection