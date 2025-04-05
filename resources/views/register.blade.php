<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Gradient Background */
        body {
            background: #101c0c;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Registration Card */
        .card {
            max-width: 450px;
            width: 100%;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            color: #333;
            padding: 30px;
        }

        /* Role Selection Buttons */
        .role-btn {
            flex-grow: 1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            background: #f8f9fa;
            color: #333;
            transition: all 0.3s ease-in-out;
            border: 2px solid transparent;
        }

        .role-btn.active {
            background-color: #101c0c;
            color: white;
            border-color: #101c0c;
            box-shadow: 0 0 10px rgba(16, 28, 12, 0.5);
        }

        .role-btn:hover {
            background-color: #dfe6e9;
        }

        /* Form Inputs */
        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ced4da;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #101c0c;
            box-shadow: 0 0 10px rgba(16, 28, 12, 0.5);
        }

        /* Submit Button */
        .btn-register {
            background: #101c0c;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: #0d160a;
        }

        /* Links */
        a {
            text-decoration: none;
            color: #101c0c;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .card {
            max-width: 450px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="text-center mb-4">
                <img src="{{ asset('images/food_app_logo.png') }}" alt="Logo" class="mb-3" style="width: 150px;">
                <h3 class="fw-bold">Create an Account</h3>
                <p class="text-muted">Join us today and enjoy the experience!</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <input type="hidden" id="role" name="role" value="{{ session('role', 'User') }}">

                <div class="d-flex justify-content-between gap-2 mb-4">
                    <button type="button" class="btn role-btn active" data-role="User" onclick="setRole(this)">Customer</button>
                    <button type="button" class="btn role-btn" data-role="Vendor" onclick="setRole(this)">Restaurant</button>
                    <button type="button" class="btn role-btn" data-role="Rider" onclick="setRole(this)">Runner</button>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-medium">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-medium">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-medium">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-medium">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-medium">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-register w-100">Register</button>
                </div>
                <div class="text-center mt-3">
                    <a href="/">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setRole(button) {
            let role = button.getAttribute('data-role');
            document.getElementById('role').value = role;

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

</body>

</html>