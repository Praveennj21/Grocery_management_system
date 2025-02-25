<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px; /* Adjusted for fixed navbar */
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding-top: 20px;
            padding-right: 20px;
            padding-left: 20px;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable sidebar */
            background-color: #343a40;
            color: #ffffff;
        }

        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 20px;
        }

        .main-content {
            margin-left: 240px; /* Adjusted to match sidebar width */
            padding: 20px;
        }

        h2 {
            color: #007bff;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Your Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href='logout.php'>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href='dashboard.php'>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='profile.php'>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    Student Details
                </a>
            </li>
            <!-- Add more menu items as needed -->
        </ul>
    </div>
</nav>

<!-- Main content -->
<div class="main-content">
    <h2>Student Details</h2>
    <p>This is the student details page. You can display information about students here.</p>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
