<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <style>
		body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    padding: 1em;
    text-align: center;
}

header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

header nav ul li {
    display: inline-block;
    margin-right: 20px;
}

header nav a {
    color: #fff;
    text-decoration: none;
}

.login-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    display: flex;
    justify-content: space-between;
    width: 80%;
}

.login-box {
    background-color: #f0f0f0;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 30%;
}

.login-box h3 {
    margin-top: 0;
}

.login-box a {
    text-decoration: none;
    color: blue;
}

.login-box a:hover {
    color: #555;
}
	</style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="login-section">
            <h2>Login Options</h2>
            <div class="login-container">
                <div class="login-box">
                    <h3>Admin Login</h3>
                    <a href="admin_login.php">Login as Admin</a>
                </div>
                <div class="login-box">
                    <h3>Vendor Login</h3>
                    <a href="vendor_login.php">Login as Vendor</a>
                </div>
                <div class="login-box">
                    <h3>User Login</h3>
                    <a href="user_login.php">Login as User</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
