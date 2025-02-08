<?php
include('db.php');

// Fetch products with remaining quantity less than 20
$sql = "SELECT id, name, remaining FROM products WHERE remaining < 20";
$result = $conn->query($sql);

$lowQuantityProducts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lowQuantityProducts[] = [
            'id' => $row['id'],
            'name' => $row['name'], 
            'remaining' => $row['remaining'],
        ];
    }
} else {
    // If no low quantity products, display a 3D-styled message
    echo "<div class='no-products-container'><div class='no-products-message'>No products with remaining quantity less than 20 found.</div></div>";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Quantity Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background: linear-gradient(135deg, #f3f9f1, #dcedc1);
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            margin-top: 30px;
        }
        h2 {
            color: #2e7d32;
            font-size: 2.5rem;
            text-shadow: 1px 1px #e8f5e9;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f8e9;
            transition: background-color 0.3s ease-in-out;
        }
        .navigation-container {
            position: fixed;
            top: 50px;
            right: 50px;
            z-index: 1000;
        }
        .navigation-icon {
            font-size: 40px;
            text-decoration: none;
            color: #007bff;
            transition: transform 0.4s, color 0.4s;
        }
        .navigation-icon:hover {
            transform: rotate(360deg);
            color: #2e7d32;
        }
        .btn-primary {
            background-color: #33691e;
            border: none;
        }
        .btn-primary:hover {
            background-color: #558b2f;
        }
        /* Animated table row effects */
        tbody tr:nth-child(odd) {
            animation: fadeInUp 0.8s;
        }
        tbody tr:nth-child(even) {
            animation: fadeInRight 0.8s;
        }
        tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .no-products-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ffccbc, #ffe0b2);
        }
        .no-products-message {
            background: #ff7043;
            padding: 20px 40px;
            border-radius: 15px;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px #bf360c;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transform: perspective(800px) rotateX(15deg);
            animation: float 2s infinite;
        }
        @keyframes float {
            0% {
                transform: perspective(800px) rotateX(15deg) translateY(0);
            }
            50% {
                transform: perspective(800px) rotateX(15deg) translateY(-10px);
            }
            100% {
                transform: perspective(800px) rotateX(15deg) translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="table-container animate__animated animate__fadeIn">
        <h2>Low Quantity Products</h2>

        <!-- Table to display low quantity products -->
        <table class="table table-hover mt-3">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Remaining</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lowQuantityProducts as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['remaining']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Navigation Icon -->
<div class="navigation-container">
    <a href="dashboard.php" class="navigation-icon">▶</a>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>