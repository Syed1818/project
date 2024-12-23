<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome, Admin</h1>
    </header>
    <main>
        <section>
            <h2>Admin Functions</h2>
            <ul>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </section>
    </main>
</body>
</html>
