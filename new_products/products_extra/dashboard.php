<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
body {
    padding-top: 56px;
    background: linear-gradient(135deg, #f7ffe5, #d4e157);
    font-family: 'Poppins', sans-serif; /* Sleeker font style */
    font-size: 1rem;
    color: #333333;
}

.sidebar {
    position: fixed;
    top: 56px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    padding: 20px;
    background-color: #3e4e2d;
    color: #ffffff;
    width: 240px;
    font-size: 1.2rem;
    box-shadow: 3px 0 8px rgba(0, 0, 0, 0.1);
    border-radius: 0 10px 10px 0;
}

.sidebar a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s, background-color 0.3s;
}

.sidebar a:hover {
    color: #cddc39;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
}

.sidebar .nav-link.active {
    background-color: #8bc34a;
    color: white;
    border-radius: 5px;
    font-weight: 700;
}

.main-content {
    margin-left: 260px;
    padding: 30px;
}

h2 {
    color: #2e7d32;
    font-size: 3rem;
    animation: fadeInDown 2s;
    font-weight: bold;
    letter-spacing: 1.2px;
    text-shadow: 1px 2px 3px rgba(0, 0, 0, 0.15);
}

p {
    font-size: 1.2rem;
    color: #616161;
    line-height: 1.7;
    letter-spacing: 0.8px;
    word-spacing: 2px;
    font-weight: 500;
}

.btn-animated {
    transition: transform 0.3s ease-in-out;
    font-size: 1.1rem;
    padding: 10px 20px;
    font-weight: 600;
    background-color: #558b2f;
    color: white;
    border: none;
    border-radius: 5px;
}

.btn-animated:hover {
    transform: scale(1.1);
    background-color: #33691e;
}

.grocery-banner {
    background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=800&q=80') no-repeat center center;
    background-size: cover;
    height: 200px;
    border-radius: 10px;
    animation: fadeIn 3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

ul.nav.flex-column {
    font-size: 1.2rem;
    font-weight: 500;
}

.nav-item i {
    margin-right: 10px;
}

a.nav-link {
    font-weight: 600;
    letter-spacing: 0.5px;
}

.navbar-brand {
    font-size: 2rem;
    font-weight: bold;
    color: #33691e;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Typography Animations for Buttons and Links */
@keyframes pulseText {
    0% { letter-spacing: 0px; }
    50% { letter-spacing: 1px; }
    100% { letter-spacing: 0px; }
}

.sidebar a:hover,
.btn-animated:hover,
.navbar-brand:hover {
    animation: pulseText 0.4s ease-in-out;
}
/* Full-Width Navbar */
.custom-navbar {
        width: 100%;
        background-color: #004d00; /* Dark Green */
        padding: 12px 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }

    /* 3D Effect for Brand Text */
    .navbar-brand {
        font-family: 'Arial', sans-serif;
        font-size: 28px;
        font-weight: bold;
        color: #33ff33; /* Neon Green */
        text-shadow: 3px 3px 8px rgba(0, 255, 0, 0.7), 0 0 12px rgba(0, 255, 0, 0.6); /* 3D Neon Effect */
        letter-spacing: 2px;
    }

    /* Nav Links Styling */
    .nav-link {
        font-size: 20px;
        font-weight: bold;
        color: #ccffcc; /* Light Green */
        text-shadow: 2px 2px 5px rgba(0, 255, 0, 0.5); /* Soft 3D Effect */
        transition: transform 0.3s ease, text-shadow 0.3s ease;
    }

    /* Hover Effect */
    .nav-link:hover {
        color: #33ff33; /* Brighter Green */
        transform: scale(1.1);
        text-shadow: 4px 4px 12px rgba(0, 255, 0, 0.8);
    }

    /* Navbar Toggler Button */
    .navbar-toggler {
        background-color: #33ff33; /* Green Toggle Button */
    }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand animate__animated animate__fadeInLeft" href="#">GROCERY DASHBOARD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn-animated" href='logout.php'>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<nav class="sidebar animate__animated animate__fadeInLeft">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="products.php">
                    <i class="fas fa-apple-alt"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='bill.php'>
                   <i class="fas fa-file-invoice"></i> New Bill
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='total_amount.php'>
                    <i class="fas fa-dollar-sign"></i> Total Amount
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='remaining.php'>
                  <i class="fas fa-exclamation-circle"></i> Low Stock
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='shop.php'>
                  <i class="fas fa-store"></i> Shop Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='employee.php'>
                  <i class="fas fa-users"></i> Employee Details
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main content -->
<div class="main-content">
    <div class="grocery-banner mb-4"></div>
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <p>Explore your grocery dashboard and manage your tasks efficiently.</p>
</div>

<!-- Bootstrap JS, Popper.js, and FontAwesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>