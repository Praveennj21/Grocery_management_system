<?php
// Include the database connection file
include('db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $owner = $_POST['owner'];
    $manager = $_POST['manager'];
    $phone = $_POST['phone'];
    $license_no = $_POST['license_no'];

    // Prepare the SQL statement
    $sql = "INSERT INTO shop (name, address, owner, manager, phone, license_no) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssssss", $name, $address, $owner, $manager, $phone, $license_no);
        $result = $stmt->execute();

        if ($result) {
            echo "<div class='alert alert-success'>Shop data added successfully.</div>";
            // Redirect to avoid form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error adding shop data: " . $stmt->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error preparing SQL statement: " . $conn->error . "</div>";
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch all shop data
$sql = "SELECT * FROM shop";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shop Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
        /* 3D Glow Hover Effect */
        tbody tr:hover td {
            background: linear-gradient(145deg, #e0f7fa, #80deea);
            box-shadow: 0 0 12px rgba(0, 184, 212, 0.6);
            border-radius: 8px;
            transition: all 0.4s ease-in-out;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add Shop Details</h2>
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addShopModal">
        Add Shop Details
    </button>

    <!-- Display shop data if available -->
    <?php if ($result->num_rows > 0): ?>
        <div class="table-container mt-4">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Shop ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Owner</th>
                        <th>Manager</th>
                        <th>Phone</th>
                        <th>License No</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['shop_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['owner']; ?></td>
                        <td><?php echo $row['manager']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['license_no']; ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4">No shop data found.</div>
    <?php endif; ?>

</div>

<!-- Modal -->
<div class="modal fade" id="addShopModal" tabindex="-1" role="dialog" aria-labelledby="addShopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addShopModalLabel">Add Shop Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add new shop details -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner:</label>
                        <input type="text" class="form-control" id="owner" name="owner" required>
                    </div>
                    <div class="form-group">
                        <label for="manager">Manager:</label>
                        <input type="text" class="form-control" id="manager" name="manager" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="license_no">License Number:</label>
                        <input type="text" class="form-control" id="license_no" name="license_no" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Shop</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="navigation-container">
    <a href="dashboard.php" class="navigation-icon">&#9658;</a>
</div>

<!-- Bootstrap JS and jQuery (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
