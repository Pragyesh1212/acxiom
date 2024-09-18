<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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

// Fetch cart data
$sql = "SELECT * FROM cart";
$result = mysqli_query($conn, $sql);
$cart_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

// Calculate grand total
$grand_total = 0;
foreach ($cart_items as $item) {
    $sql = "SELECT product_price FROM products WHERE id = '$item[product_id]'";
    $result = mysqli_query($conn, $sql);
    $product_price = mysqli_fetch_assoc($result)["product_price"];
    $grand_total += $item["quantity"] * $product_price;
}

// Remove from cart logic
if (isset($_POST["remove_from_cart"])) {
    $product_id = $_POST["product_id"];

    // Remove product from cart
    $sql = "DELETE FROM cart WHERE product_id = '$product_id'";
    mysqli_query($conn, $sql);
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="user.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Order Status</a>
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

    .cart-item {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-item img {
        width: 50px;
        height: 50px;
        margin: 10px;
    }

    .cart-item h2 {
        margin-top: 0;
    }

    .cart-item .price {
        font-size: 18px;
        font-weight: bold;
        color: #337ab7;
    }

    .cart-item .quantity {
        font-size: 16px;
        font-weight: bold;
        color: #337ab7;
    }

    .remove {
        background-color: #337ab7;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .remove:hover {
        background-color: #23527c;
    }

    .grand-total {
        font-size: 24px;
        font-weight: bold;
        color: #337ab7;
    }

    .proceed-to-checkout {
        background-color: #337ab7;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .proceed-to-checkout:hover {
        background-color: #23527c;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Cart</h1>
    </div>

    <div class="cart-list">
        <?php foreach ($cart_items as $item) { ?>
        <div class="cart-item">
            <?php
            $sql = "SELECT product_image, product_name, product_price FROM products WHERE id = '$item[product_id]'";
            $result = mysqli_query($conn, $sql);
            $product_info = mysqli_fetch_assoc($result);
            ?>
            <img src="<?php echo $product_info["product_image"]; ?>" alt="<?php echo $product_info["product_name"]; ?>">
            <h2><?php echo $product_info["product_name"]; ?></h2>
            <p class="price">$<?php echo $item["quantity"] * $product_info["product_price"]; ?></p>
            <p class="quantity">Quantity: <?php echo $item["quantity"]; ?></p>
            <form action="" method="post">
                <input type="hidden" name="product_id" value="<?php echo $item["product_id"]; ?>">
                <button class="remove" name="remove_from_cart">Remove</button>
            </form>
        </div>
        <?php } ?>
    </div>

    <div class="grand-total">
        <h2>Grand Total: $<?php echo $grand_total; ?></h2>
    </div>

    <button class="proceed-to-checkout" onclick="proceedToCheckout()">Proceed to Checkout</button>

    <script>
        function proceedToCheckout() {
            // Proceed to checkout logic here
            alert("Proceeding to checkout...");
        }
    </script>
</div>