<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch vendor data
$sql = "SELECT * FROM vendors";
$result = mysqli_query($conn, $sql);
$vendors = array();
while ($row = mysqli_fetch_assoc($result)) {
    $vendors[] = $row;
}

// Process update and delete actions
if (isset($_POST["vendor_action"])) {
    if ($_POST["vendor_action"] == "update_vendor") {
        $vendor_id = $_POST["vendor_id"];
        $vendor_name = $_POST["vendor_name"];
        $vendor_email = $_POST["vendor_email"];

        // Update vendor data in database
        $sql = "UPDATE vendors SET name = '$vendor_name', email = '$vendor_email' WHERE id = $vendor_id";
        mysqli_query($conn, $sql);
    } elseif ($_POST["vendor_action"] == "delete_vendor") {
        $vendor_id = $_POST["vendor_id"];

        // Delete vendor from database
        $sql = "DELETE FROM vendors WHERE id = $vendor_id";
        mysqli_query($conn, $sql);
    }
}
?>
<header>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="vendor_logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #f0f0f0;
    }
</style>

<h1>Manage Vendors</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($vendors as $vendor) { ?>
    <tr>
        <td><?php echo $vendor["id"]; ?></td>
        <td><?php echo $vendor["name"]; ?></td>
        <td><?php echo $vendor["email"]; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="vendor_id" value="<?php echo $vendor["id"]; ?>">
                <input type="submit" name="vendor_action" value="update_vendor" class="edit-link"> Edit
                <input type="submit" name="vendor_action" value="delete_vendor" class="delete-link"> Delete
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<form method="post">
    <label for="vendor_name">Name:</label>
    <input type="text" id="vendor_name" name="vendor_name" required>

    <label for="vendor_email">Email:</label>
    <input type="email" id="vendor_email" name="vendor_email" required>

    <input type="submit" value="Add Vendor" name="vendor_action" value="add_vendor">
</form>