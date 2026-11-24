<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Store') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }
        .navbar li {
            margin-right: 1rem;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
        }
        .navbar .spacer {
            margin-left: auto;
        }
        .main-content {
            padding: 2rem;
        }
        .hero {
            position: relative;
            height: 400px;
            padding: 2rem;
            text-align: center;
        }
        .hero-content p, .hero-content h1 {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(90deg, #ff8000, #d01500, #f6f8f9);
            background-size: 300% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }
        .hero-content p:hover, .hero-content h1:hover {
            animation: wave-gradient 4s ease-in-out infinite alternate;
        }
        @keyframes wave-gradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        .hero-content img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .hero-content .btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(75deg, #ff8000, #d06f00, #e4dd04);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .hero-content .btn:hover {
            background: linear-gradient(75deg, #ff6600, #bc6501, #9a9500);
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
            gap: 1rem;
        }
        .feature {
            width: 30%;
            background-color: #eaeaea;
            padding: 1rem;
            text-align: center;
        }
        .products {
            margin-top: 2rem;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: flex-start;
        }
        .product {
            width: 30%;
            background-color: #eaeaea;
            padding: 1rem;
            text-align: center;
            box-sizing: border-box;
        }
        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product .price {
            font-weight: bold;
            color: #d01500;
        }
        .empty {
            color: #666;
            font-style: italic;
        }
        .contact {
            margin-top: 2rem;
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="spacer"></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Admin Panel</a></li>
                @else
                    <li><a href="{{ route('login') }}">Admin Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <section class="hero" id="home">
            <div class="hero-content">
                <img src="{{ asset('images/hero-img.png') }}" alt="Hero Image">
                <h1>Welcome to Our Website</h1>
                <p>This is a sample hero section with some introductory text.</p>
                <a href="#products" class="btn">Learn More</a>
            </div>
        </section>

        <section class="features" id="services">
            <div class="feature">
                <h2>Feature 1</h2>
                <p>Description of feature 1.</p>
            </div>
            <div class="feature">
                <h2>Feature 2</h2>
                <p>Description of feature 2.</p>
            </div>
            <div class="feature">
                <h2>Feature 3</h2>
                <p>Description of feature 3.</p>
            </div>
        </section>

        <section class="products" id="products">
            <h2>Our Products</h2>
            <p>Check out our latest products!</p>

            @if ($products->isEmpty())
                <p class="empty">No products yet. Please check back soon.</p>
            @else
                <div class="product-list">
                    @foreach ($products as $product)
                        <div class="product">
                            <h3>{{ $product->name }}</h3>
                            @if ($product->image)
                                <img src="{{ \Storage::url($product->image) }}" alt="{{ $product->name }}">
                            @endif
                            <p>{{ $product->description }}</p>
                            <p class="price">${{ number_format((float) $product->price, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="contact" id="contact">
            <h2>Contact Us</h2>
            <p>This is a demo contact section.</p>
        </section>
    </main>

    <footer class="footer" id="about">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
