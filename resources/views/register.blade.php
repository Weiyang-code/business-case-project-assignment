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
    
    <script>
        function setRole(button) {
            document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        }
    </script>

</body>
</html>
