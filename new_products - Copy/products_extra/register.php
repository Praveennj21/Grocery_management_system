<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];

    $sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Background Styling */
        body {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), 
                        url('https://source.unsplash.com/1600x900/?nature,sky') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Frosted-glass card */
        .container {
            max-width: 400px;
        }

        .card {
            backdrop-filter: blur(15px) saturate(180%);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
            color: white;
        }

        .card-header {
            background: linear-gradient(135deg, #4CAF50, #8BC34A);
            color: white;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(45deg, #4CAF50, #8BC34A);
            border: none;
            border-radius: 25px;
            transition: transform 0.2s, background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #388E3C, #689F38);
            transform: scale(1.05);
        }

        /* Form Styling */
        .form-control {
            border-radius: 25px;
            border: 1px solid #ced4da;
        }

        .text-center a {
            color: #8BC34A;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action='register.php' method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href='login.php'>Login here</a>.</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
