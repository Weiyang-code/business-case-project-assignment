<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        header {
            background: #222;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: auto;
        }
        .logo {
            font-size: 24px;
            color: #fff;
            font-weight: bold;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            transition: 0.3s;
        }
        nav ul li a:hover {
            color: #ff6347;
        }
        .order-btn {
            background: #ff6347;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }
        .hero {
            background: url("{{ asset('images/bighome.jpg') }}") center/cover no-repeat;
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            font-size: 28px;
            font-weight: bold;
        }

        .offers {
            display: flex;
            gap: 20px;
            padding: 50px 10%;
        }
        .offer-box {
            flex: 1;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .offer-box img {
            width: 100%;
            transition: 0.3s;
        }
        .offer-box:hover img {
            transform: scale(1.05);
        }
        .overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #ff6347;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info-section {
            display: flex;
            gap: 20px;
            padding: 50px 10%;
        }
        .info-box {
            flex: 1;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            color: white;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">UCSI Foodie</div>
            <ul>
                <li><a href="#about">About Us</a></li>
                <li><a href="#menu">Menus</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#order" class="order-btn">Order Now</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>CHECK OUT OUR FOOD</h1>
        <p>AND PLACE AN ORDER EASILY</p>
    </section>

    <section class="offers">
        <div class="offer-box">
            <!-- <img src="images/lunchhome.png" alt="Weekend Offer"> -->
            <img src="{{ asset('images/lunchhome.png') }}" alt="Weekend Offer">

            <div class="overlay">
                <h2>Weekend Offer</h2>
                <p>Enjoy our discounted menu every weekend</p>
                <a href="#order" class="btn">Start Ordering</a>
            </div>
        </div>
        <div class="offer-box reservation" style="background: green; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">
            RESERVATION
        </div>
        <div class="offer-box">
            <img src="order-now.jpg" alt="Order Now">
            <div class="overlay">
                <h2>ORDER NOW</h2>
            </div>
        </div>
    </section>

    <section class="info-section">
        <div class="info-box" style="background-image: url('photos.jpg');">PHOTOS</div>
        <div class="info-box" style="background-image: url('about-us.jpg');">ABOUT US</div>
        <div class="info-box" style="background-image: url('contact-us.jpg');">CONTACT US</div>
    </section>
</body>
</html>