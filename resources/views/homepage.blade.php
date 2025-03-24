<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Page</title>
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
<body class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">

    <!-- Banner Section (Now with Background Image) -->
    <div class="banner">
        <img src="C:/Users/WeiYang/food_banner.png" class="banner-img">
        
    </div>

    <!-- Login Card -->
    <div class="card shadow p-4 mt-3" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3>

        <!-- Role Selection Buttons with Spacing -->
        <div class="d-flex justify-content-between gap-2 mb-3">
            <button type="button" class="btn role-btn active" onclick="setRole(this)">User</button>
            <button type="button" class="btn role-btn" onclick="setRole(this)">Vendor</button>
            <button type="button" class="btn role-btn" onclick="setRole(this)">Rider</button>
        </div>

        <form action="login.php" method="POST">
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
                <a href="register.php" class="btn btn-outline-secondary w-100">Register</a>
            </div>
        </form>
    </div>

    <script>
        function setRole(button) {
            document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        }
    </script>

</body>
</html>
