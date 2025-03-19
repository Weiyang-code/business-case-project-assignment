<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Login Page</title>
    </head>
    <body class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">
    
    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center">Login</h3>

        <!-- Role Selection Buttons -->
        <div class="d-flex justify-content-around mb-3">
            <button type="button" class="btn btn-outline-primary btn-sm" style="border: none;">User</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="border: none;">Vendor</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="border: none;">Rider</button>
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
        </form>
    </div>

    <!-- Register Button (Placed Under the Card) -->
    <div class="mt-3">
        <a href="register.php" class="btn btn-outline-secondary">Register</a>
    </div>

</body>
</html>
