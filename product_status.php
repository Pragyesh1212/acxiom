<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_status = $_POST["product_status"];

    // Insert product status into database
    $sql = "UPDATE product_status SET product_status = '$product_status' WHERE id = $product_id";
    mysqli_query($conn, $sql);

    // Display success message
    echo "Product status updated successfully!";
}

// Fetch product data from database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Display product status form
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
        }

        .header a:hover {
            color: #ccc;
        }

        .header ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }

        .header li {
            margin-right: 20px;
        }

        .content {
            padding: 20px;
        }

        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }
    </style>

    <header class="header">
        <ul>
            <li><a href="vendor.php" class="product-status-link">Home</a></li>
            <li><a href="view_product.php" class="view-product-link">View Product</a></li>
            <li><a href="vendor_logout.php" class="logout-link">Logout</a></li>
        </ul>
    </header>
    <main class="content">
        <h2>Product Status Form</h2>
        <form method="post">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_status">Product Status:</label>
            <input type="text" id="product_status" name="product_status" required>

            <input type="submit" value="Update Product Status">
        </form>
    </main>
    <?php
} else {
    echo "No products found.";
}
?>

<?php
// Close the database connection
mysqli_close($conn);
?>