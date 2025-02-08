<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION["username"] = $username;
            header('Location: dashboard.php');
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "User not found";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Full-page background styling */
        body {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), 
                        url('https://source.unsplash.com/1600x900/?mountains,sunset') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Centered card with frosted-glass effect */
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
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: white;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
            border: none;
            border-radius: 25px;
            transition: transform 0.2s, background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #e96443, #fbc2eb);
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 25px;
            border: 1px solid #ced4da;
        }

        .alert {
            background: rgba(255, 0, 0, 0.1);
            color: white;
            border: none;
        }

        .text-center a {
            color: #feb47b;
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
            Login
        </div>
        <div class="card-body">
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href='register.php'>Register here</a>.</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
