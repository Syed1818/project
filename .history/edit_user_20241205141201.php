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
    <title>Edit User</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(120deg, #f6d365, #fda085);
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h1 {
    text-align: center;
    margin-bottom: 1rem;
    color: #4CAF50;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

label {
    font-weight: bold;
}

input {
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 0.5rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <header>
        <h1>Edit User</h1>
    </header>
    <main>
        <section class="user-form">
            <h2>Edit User Information</h2>
            <form action="edit_user.php?"id="<?php echo $user['id']; ?>" method="POST">
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

