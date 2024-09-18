<?php
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "event_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Query database for admin credentials
        $query = "SELECT * FROM vendors WHERE email = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        // Check if admin credentials are correct
        if (mysqli_num_rows($result) > 0) {
            // Login successful, redirect to admin dashboard
            header("Location: vendor.php");
            exit;
        } else {
            // Login failed, display error message
            $error = "Invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Login</title>
    <style>
body {
	background-color: #f2f2f2;
	font-family: Arial, sans-serif;
}

.container {
	width: 50%;
	margin: 40px auto;
	padding: 20px;
	border: 1px solid #ccc;
	border-radius: 10px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
	text-align: center;
}

label {
	display: block;
	margin-bottom: 10px;
}

input[type="text"], input[type="password"] {
	width: 100%;
	padding: 10px;
	margin-bottom: 20px;
	border: 1px solid #ccc;
}

input[type="submit"] {
	background-color: #4CAF50;
	color: #fff;
	padding: 10px 20px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}

input[type="submit"]:hover {
	background-color: #3e8e41;
}
    </style>
</head>

<body>
	<div class="container">
		<h1>Vendor Login</h1>
		<form action="vendor_login.php" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" placeholder="E-mail ID"><br><br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" placeholder="Password"><br><br>
			<input type="submit" value="Login">
		</form>
		<?php
                if (isset($error)) {
                    echo "<p>$error</p>";
                }
            ?>
		<p>Don't have an account? <a href="vendor_signup.php">Sign Up</a></p>
		
	</div>
</body>
</html>

<?php
    // Close database connection
    mysqli_close($conn);
?>
