<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "event_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Process update and delete actions
if (isset($_POST["user_action"])) {
    if ($_POST["user_action"] == "update_user") {
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];
        $email = $_POST["email"];

        // Update user data in database
        $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id";
        mysqli_query($conn, $sql);
    } elseif ($_POST["user_action"] == "delete_user") {
        $user_id = $_POST["user_id"];

        // Delete user from database
        $sql = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($conn, $sql);
    }
}

// Header with home and logout links
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

<h1>Manage Users</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user["id"]; ?></td>
        <td><?php echo $user["email"]; ?></td>
        <td><?php echo $user["password"]; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="user_id" value="<?php echo $user["id"]; ?>">
                <input type="submit" name="user_action" value="update_user" class="edit-link"> Edit
                <input type="submit" name="user_action" value="delete_user" class="delete-link"> Delete
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <input type="submit" value="Add User" name="user_action" value="add_user">
</form>