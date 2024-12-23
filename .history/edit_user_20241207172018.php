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
    $new_password = $_POST['password']; // Use plain-text password

    // Optional: Update password only if provided (don't hash it)
    if (!empty($new_password)) {
        $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $new_username, $new_email, $new_password, $user_id); // Store password as plain text
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
            background: #1c1c1c; /* Black background */
            color: #f1f1f1; /* Light text */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: #2a2a2a; /* Dark background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #ff7f00; /* Orange */
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #f1f1f1; /* Light text */
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #f1f1f1; /* Light text */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 2px solid #333; /* Dark border */
            border-radius: 5px;
            font-size: 16px;
            background: #1c1c1c; /* Black input background */
            color: #f1f1f1; /* Light text */
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #ff7f00; /* Orange border on focus */
            outline: none;
        }

        button {
            padding: 12px;
            background-color: #ff7f00; /* Orange */
            color: #1c1c1c; /* Black text */
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e56d00; /* Darker orange */
        }

        .note {
            text-align: center;
            font-size: 14px;
            color: #777; /* Light gray */
        }

        .note a {
            color: #ff7f00; /* Orange links */
            text-decoration: none;
        }

        .note a:hover {
            text-decoration: underline;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                font-size: 14px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <h2>Update User Information</h2>
        <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Password (Leave empty to keep current password)</label>
            <input type="password" id="password" name="password">

            <button type="submit">Update User</button>
        </form>
        <p class="note">Want to go back? <a href="manage_users.php">Manage Users</a></p>
    </div>
</body>
</html>

