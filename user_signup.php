<?php
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "event_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Insert data into database
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: user_login.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

input[type="text"], input[type="email"], input[type="password"] {
	width: 100%;
	padding: 10px;
	margin-bottom: 20px;
	border: 1px solid #ccc;
}

select {
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
		<h1> User Signup</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name"><br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email"><br><br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password"><br><br>
			<input type="submit" value="Signup">
		</form>
	</div>
</body>
</html>

<?php
    // Close database connection
    mysqli_close($conn);
?>
