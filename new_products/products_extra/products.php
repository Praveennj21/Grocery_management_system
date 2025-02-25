<?php
include('db.php');

// Read Operation - Fetch product data
$productSql = "SELECT id, name, price, quantity, image_path FROM products";
$productResult = $conn->query($productSql);

// Read Operation - Fetch quantity sold data
$billSql = "SELECT id, COALESCE(SUM(quantity), 0) AS quantity_sold FROM bill GROUP BY id";
$billResult = $conn->query($billSql);

// Update Operation - Update remaining quantity in products table
while ($productRow = $productResult->fetch_assoc()) {
    $id = $productRow['id'];
    $quantitySold = 0;

    // Check if there is corresponding quantity sold data
    while ($billRow = $billResult->fetch_assoc()) {
        if ($billRow['id'] == $id) {
            $quantitySold = $billRow['quantity_sold'];
            break;
        }
    }

    // Calculate remaining quantity
    $remaining = $productRow['quantity'] - $quantitySold;
    $remaining = ($remaining < 0) ? 0 : $remaining;

    // Update remaining quantity in products table
    $updateSql = "UPDATE products SET remaining = $remaining WHERE id = $id";
    $conn->query($updateSql);

    // Add product information to the array
    $productRow['quantity_sold'] = $quantitySold;
    $productRow['remaining'] = $remaining;
    $products[] = $productRow;

    // Reset the internal pointer for the next iteration
    $billResult->data_seek(0);
    if ($remaining < 20) {
        $lowQuantityProducts[] = [
            'id' => $id,
            'name' => $productRow['name'],
            'remaining' => $remaining,
        ];
    }

    // Reset the internal pointer for the next iteration
    $billResult->data_seek(0);
}

// Close the database connection
$conn->close();
?>

<script>
// JavaScript code to show pop-up window for low-quantity products
document.addEventListener("DOMContentLoaded", function() {
    <?php foreach ($lowQuantityProducts as $product): ?>
        alert("Low Quantity Alert: Product ID - <?php echo $product['id']; ?>,  Name - <?php echo $product['name']; ?>,  Remaining - <?php echo $product['remaining']; ?>");
    <?php endforeach; ?>
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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


        .navigation-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .navigation-icon {
        font-size: 40px;
        text-decoration: none;
        color: #007bff;
        transition: transform 0.3s;
    }

    .navigation-icon:hover {
        transform: rotate(360deg);
        color: #558b2f;
    }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Product List</h2>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
        Add Product
    </button>

    <!-- Table to display products -->
    <div class="table-container mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Quantity Sold</th>
                    <th>Remaining</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td><?php echo $product['quantity_sold']; ?></td>
                        <td><?php echo $product['remaining']; ?></td>
                        <td>
                            <?php if (!empty($product['image_path'])): ?>
                                <img src="<?php echo $product['image_path']; ?>" alt="Product Image" height="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateProductModal_<?php echo $product['id']; ?>">
                                Update
                            </button>

                            <!-- Update Product Modal -->
                            <div class="modal fade" id="updateProductModal_<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel_<?php echo $product['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateProductModalLabel_<?php echo $product['id']; ?>">Update Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for updating product -->
                                            <form action="update_product.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                <div class="form-group">
                                                    <label for="name">Product Name:</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price:</label>
                                                    <input type="number" class="form-control" name="price" min="0" step="0.01" value="<?php echo $product['price']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" class="form-control" name="quantity" min="0" value="<?php echo $product['quantity']; ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Navigation Icon Container -->
<div class="navigation-container">
    <a href="dashboard.php" class="navigation-icon">▶</a>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new product -->
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>