<html>
<head></head>
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

    .dashboard {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .dashboard-section {
        width: 30%;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .dashboard-section h2 {
        margin-top: 0;
    }

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

<header class="header">
    <ul>
        <li><a href="profile.php" class="profile-link">Profile</a></li>
        <li><a href="vendor_logout.php" class="logout-link">Logout</a></li>
    </ul>
</header>
<main class="content">
    <h1>Admin Dashboard</h1>
    <div class="dashboard">
        <div class="dashboard-section">
            <h2>Users</h2>
            <a href="manage-users.php">Manage Users</a>
        </div>
        <div class="dashboard-section">
            <h2>Vendors</h2>
            <a href="manage-vendors.php">Manage Vendors</a>
        </div>
    </div>
</main>
</html>