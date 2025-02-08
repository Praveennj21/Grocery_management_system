<?php
include('db.php');

// Fetch transaction and total amount data using a JOIN
$sql = "SELECT b.transaction_id, COALESCE(SUM(b.amount), 0) AS total_amount
        FROM bill b
        GROUP BY b.transaction_id";

$result = $conn->query($sql);

// Process the combined data
$transactionTotals = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Store the combined data in the $transactionTotals array
        $transactionTotals[] = [
            'transaction_id' => $row['transaction_id'],
            'total_amount' => $row['total_amount'],
        ];

        // Insert into the "total_amount" table inside the loop
        $transactionId = $row['transaction_id'];
        $totalAmount = $row['total_amount'];

        $insertSql = "INSERT INTO total_amount (transaction_id, total) VALUES ($transactionId, $totalAmount)";
        $conn->query($insertSql);
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Amounts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background: linear-gradient(135deg, #f3f9f1, #dcedc1);
            font-family: 'Arial', sans-serif;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #33691e;
            font-size: 2rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f8e9;
        }
        .navigation-container {
            position: fixed;
            top: 50px;
            right: 50px;
            z-index: 1000;
        }
        .navigation-icon {
            font-size: 35px;
            text-decoration: none;
            color: #007bff;
            transition: transform 0.3s;
        }
        .navigation-icon:hover {
            transform: rotate(90deg);
        }
        .btn-primary {
            background-color: #33691e;
            border: none;
        }
        .btn-primary:hover {
            background-color: #558b2f;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="table-container animate__animated animate__fadeIn">
        <h2>Total Amounts</h2>

        <!-- Table to display total amounts -->
        <table class="table table-hover mt-3">
            <thead class="thead-light">
            <tr>
                <th>Transaction ID</th>
                <th>Total Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($transactionTotals as $total): ?>
                <tr>
                    <td><?php echo $total['transaction_id']; ?></td>
                    <td>$<?php echo number_format($total['total_amount'], 2); ?></td>
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
