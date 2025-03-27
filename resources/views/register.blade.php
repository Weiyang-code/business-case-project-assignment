<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register Page</title>
    <style>
        /* Banner Section with Background Image */
        .banner {
            width: 100%;
            height: 250px;
            background: url('food_banner.png') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        /* Role Button Styling */
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
    </style>
</head>


<div class="container mt-5 d-flex justify-content-center">


    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">

            <h3 class="text-center mb-4">Register</h3>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <input type="hidden" id="role" name="role" value="{{ session('role', 'User') }}">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" required>
                    @error('firstName')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> -->

                <!-- <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" required>
                    @error('lastName')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> -->

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between gap-2 mb-3">
                    <button type="button" class="btn role-btn active" onclick="setRole(this)">User</button>
                    <button type="button" class="btn role-btn" onclick="setRole(this)">Vendor</button>
                    <button type="button" class="btn role-btn" onclick="setRole(this)">Rider</button>
                </div>

                <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-secondary w-100">Register</button>
                </div>
                <div class="text-center mt-3">
                    <a href="/">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setRole(button) {
        let role = button.innerText;
        document.getElementById('role').value = role;

        // Send AJAX request to update session
        fetch("{{ route('set.session.role') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                role: role
            })
        }).then(response => response.json()).then(data => {
            console.log("Role updated in session:", data);
        }).catch(error => console.error("Error updating session:", error));

        document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    }
</script>

</html>