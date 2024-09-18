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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Page</title>
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

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .item {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 20px;
            width: 200px;
        }

        .item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .item h2 {
            margin-top: 0;
        }

        .item p {
            margin-bottom: 20px;
        }

        .add-item {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-item:hover {
            background-color: #555;
        }

        .transaction {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .transaction:hover {
            background-color: #555;
        }

        .logout {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout:hover {
            background-color: #555;
        }
		.product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
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

    </style>
</head>
<body>
    <header class="header">
        <h1>Vendor Dashboard</h1>
        <nav>
            <a href="add_item.php" class="add-item">Add Item</a>
            <a href="#" class="transaction">Transaction</a>
            <a href="vendor_logout.php" class="logout">Logout</a>
        </nav>
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
        </div>
    </main>
</body>
</html>
<?php
} else {
    echo "No products found.";
}
?>