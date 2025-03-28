@extends('layouts.app')
@section('title', 'Login Page')


@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="card shadow p-4 mt-3" style="width: 550px;">
        <h3 class="text-center mb-3">Login</h3>


        <div class="d-flex justify-content-between gap-2 mb-3">
            <button type="button" class="btn role-btn active" data-role="User" onclick="setRole(this)">User</button>
            <button type="button" class="btn role-btn" data-role="Vendor" onclick="setRole(this)">Vendor</button>
            <button type="button" class="btn role-btn" data-role="Rider" onclick="setRole(this)">Rider</button>
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

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="text-center mt-3">
                <a href="#">Forgot Password?</a>
            </div>

            <!-- Register Button (Now Inside the Card) -->
            <div class="text-center mt-3">
                <a href="{{route('register')}}" class="btn btn-outline-secondary w-100">Register</a>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set default role to "User" on first load
        const defaultRole = "User";

        // Check if the session already has a role set
        fetch("{{ route('get-role') }}")
            .then(response => response.json())
            .then(data => {
                if (!data.role) {
                    // No role set? Store "User" in session
                    setRole(document.querySelector('.role-btn[data-role="User"]'));
                }
            })
            .catch(error => console.error("Error fetching role:", error));
    });

    function setRole(button) {
        document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const selectedRole = button.getAttribute('data-role');

        //AJAX to store role in session
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