<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
            overflow-x: hidden;
        }

        /* Preloader */
        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #ddd;
            border-top-color: #28a745;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(90deg, #28a745, #218838);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
            font-weight: 600;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero-section {
            background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1600&q=80') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 150px 20px;
            position: relative;
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            text-align: center;
        }
        .feature-box img {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Testimonials */
        .testimonials {
            background: #f1f1f1;
            padding: 60px 20px;
            text-align: center;
        }

        /* Contact Form */
        .contact {
            padding: 60px 20px;
            background: #fff;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Grocery Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section" data-aos="fade-up">
    <h1>Effortlessly Manage Your Grocery Store</h1>
    <p>Track sales, inventory, and customers with ease</p>
    <a href="#" class="btn btn-warning btn-lg">Get Started</a>
</div>

<!-- Testimonials Section -->
<div class="testimonials">
    <h2>What Our Customers Say</h2>
    <p>"This system has revolutionized our grocery management! Highly recommended." - Jane Doe</p>
</div>

<!-- Contact Section -->
<div class="contact text-center">
    <h2>Contact Us</h2>
    <p>Have questions? Get in touch with us.</p>
    <form>
        <input type="text" placeholder="Your Name" class="form-control mb-3">
        <input type="email" placeholder="Your Email" class="form-control mb-3">
        <textarea placeholder="Your Message" class="form-control mb-3"></textarea>
        <button class="btn btn-success">Send Message</button>
    </form>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 Grocery Management System. All Rights Reserved.</p>
</div>

<script>
    window.onload = function () {
        document.getElementById('preloader').style.display = 'none';
    };
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
