<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connect.php';

// Fetch user data based on user ID
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT id, username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
    $stmt->close();
}

// Handle form submission to update user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password']; // In real use, hash the password before storing it

    // Optional: Hash password if provided
    if (!empty($new_password)) {
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $new_username, $new_email, $new_password_hash, $user_id);
    } else {
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_username, $new_email, $user_id);
    }

    $stmt->execute();
    $stmt->close();
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Edit User</title>
</head>
<body>
    <header>
        <h1>Edit User</h1>
    </header>
    <main>
        <section class="user-form">
            <h2>Edit User Information</h2>
            <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

                <label for="password">Password (Leave empty to keep current password)</label>
                <input type="password" id="password" name="password">

                <button type="submit">Update User</button>
            </form>
        </section>
    </main>
</body>
</html>
