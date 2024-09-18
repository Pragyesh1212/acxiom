<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create a function to add product to database
function addProduct($conn, $product_image, $product_name, $product_price) {
    $sql = "INSERT INTO products (product_image, product_name, product_price) VALUES ('$product_image', '$product_name', '$product_price')";
    if (mysqli_query($conn, $sql)) {
      header("Location: view_product.php");
      exit;
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_image = $_FILES["product_image"]["name"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    addProduct($conn, $product_image, $product_name, $product_price);
}
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

    .form {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
    }

    .form label {
        display: block;
        margin-bottom: 10px;
    }

    .form input[type="text"], .form input[type="number"], .form input[type="file"] {
        width: 100%;
        height: 40px;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .form button[type="submit"] {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form button[type="submit"]:hover {
        background-color: #555;
    }
</style>

<header class="header">
    <ul>
        <li><a href="product_status.php" class="product-status-link">Product Status</a></li>
        <li><a href="view_product.php" class="">View Product</a></li>
        <li><a href="vendor_logout.php" class="">Logout</a></li>
    </ul>
</header>
<main class="content">
    <div class="form">
        <h2>Add Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" required>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_price">Product Price:</label>
            <input type="number" id="product_price" name="product_price" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</main>