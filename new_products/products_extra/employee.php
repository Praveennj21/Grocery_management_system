<?php
// Include the database connection file
include('db.php');

// Function to get shop name by shop ID
function getShopName($conn, $shop_id) {
    $sql = "SELECT name FROM shop WHERE shop_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $shop_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return "N/A";
    }
}

// Fetch all employees
$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);

// Check if there are rows in the result for all employees
if ($result->num_rows > 0) {
    // Output data of each row for all employees
    echo "<h2>All Employee Data</h2>";
    echo "<table class='table mt-3'>
            <tr>
                <th>Employee ID</th>
                <th>Shop ID</th>
                <th>Shop Name</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['emp_id'] . "</td>";
        echo "<td>" . $row['shop_id'] . "</td>";
        // Get and display shop name
        echo "<td>" . getShopName($conn, $row['shop_id']) . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No employee data found.";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Retrieve shop ID from the form
    $search_shop_id = $_POST['search_shop_id'];
    // SQL query to fetch employees by shop ID
    $sql = "SELECT * FROM Employee WHERE shop_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $search_shop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row for search results
        echo "<h2>Search Result</h2>";
        echo "<table class='table mt-3'>
                <tr>
                    <th>Employee ID</th>
                    <th>Shop ID</th>
                    <th>Shop Name</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['emp_id'] . "</td>";
            echo "<td>" . $row['shop_id'] . "</td>";
            // Get and display shop name
            echo "<td>" . getShopName($conn, $row['shop_id']) . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found for Shop ID: $search_shop_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f3f9f1, #dcedc1);
            font-family: 'Arial', sans-serif;
        }
        h2 {
            color: #2e7d32;
            font-size: 2rem;
            text-shadow: 1px 1px #e8f5e9;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            margin-top: 30px;
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
            font-size: 35px;
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
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 2px 2px #bf360c;
        }
        tbody tr:hover td {
            background: linear-gradient(145deg, #e0f7fa, #80deea);
            box-shadow: 0 0 12px rgba(0, 184, 212, 0.6);
            border-radius: 8px;
            transition: all 0.4s ease-in-out;
        }
    </style>
</head>
<body>
<div class="navigation-container">
        <a href="dashboard.php" class="navigation-icon">
            <!-- You can use an icon font, image, or other methods for the icon -->
            <!-- For simplicity, I'll use a Unicode arrow character ▶ -->
            ▶
        </a>
    </div>

<div class="container mt-4">
    <h2>Search Employee by Shop ID</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="search_shop_id">Enter Shop ID:</label>
            <input type="number" class="form-control" id="search_shop_id" name="search_shop_id" required>
        </div>
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>
</div>
<div class="navigation-container">
        <a href="dashboard.php" class="navigation-icon">
            <!-- You can use an icon font, image, or other methods for the icon -->
            <!-- For simplicity, I'll use a Unicode arrow character ▶ -->
            ▶
        </a>
    </div>

<!-- Bootstrap JS and jQuery (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
