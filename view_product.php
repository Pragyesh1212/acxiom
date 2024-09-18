<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Display data in table format
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <header class="header">
        <ul>
            <li><a href="vendor.php" class="">Home</a></li>
            <li><a href="product_status.php" class="product-status-link">Product Status</a></li>
            <li><a href="vendor_logout.php" class="logout-link">Logout</a></li>
            
        </ul>
    </header>
    <main class="content">
        <h2>Product List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><img src="<?php echo $row["product_image"]; ?>" alt="<?php echo $row["product_name"]; ?>" class="product-image"></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td>$<?php echo $row["product_price"]; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
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