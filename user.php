<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch product data
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">User Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order-status.php">Order Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vendor_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .product-list {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-list img {
        width: 100px;
        height: 100px;
        margin: 10px;
    }

    .product-list h2 {
        margin-top: 0;
    }

    .product-list .price {
        font-size: 18px;
        font-weight: bold;
        color: #337ab7;
    }

    .product-list .quantity {
        font-size: 16px;
        font-weight: bold;
        color: #337ab7;
    }

    .add-to-cart {
        background-color: #337ab7;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-to-cart:hover {
        background-color: #23527c;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Product List</h1>
    </div>

    <div class="product-list">
        <?php foreach ($products as $product) { ?>
        <div class="product">
            <img src="<?php echo $product["product_image"]; ?>" alt="<?php echo $product["product_name"]; ?>">
            <h2><?php echo $product["product_name"]; ?></h2>
            <p class="price">$<?php echo $product["product_price"]; ?></p>
           
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                <input type="hidden" name="quantity" value="1">
                <button class="add-to-cart" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
        <?php } ?>
    </div>
</div>

<?php
// Add to cart logic
if (isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Check if product is already in cart
    $sql = "SELECT * FROM cart WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Update quantity if product is already in cart
        $sql = "UPDATE cart SET quantity = quantity + '$quantity' WHERE product_id = '$product_id'";
        mysqli_query($conn, $sql);
    } else {
        // Insert new product into cart
        $sql = "INSERT INTO cart (product_id, quantity) VALUES ('$product_id', '$quantity')";
        mysqli_query($conn, $sql);
    }
}
?>