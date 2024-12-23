<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connect.php';

// Handle user deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_users.php");
    exit();
}

// Fetch users for display
$sql = "SELECT id, username, email, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #1c1c1c; /* Black background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #f1f1f1; /* Light text */
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin-top: 50px;
            background: #2a2a2a; /* Dark background */
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            overflow: hidden;
        }

        h1, h2 {
            color: #ff7f00; /* Orange */
            text-align: center;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #ff7f00; /* Orange */
            color: #1c1c1c; /* Black text */
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            display: block;
            text-align: center;
        }

        .button:hover {
            background-color: #e56d00; /* Darker orange */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #1c1c1c; /* Black background for the table */
            color: #f1f1f1; /* Light text */
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333; /* Slightly lighter border */
        }

        th {
            background-color: #ff7f00; /* Orange header */
            color: #1c1c1c; /* Black text */
        }

        tr:hover {
            background-color: #333; /* Dark gray hover */
        }

        a {
            color: #ff7f00; /* Orange */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        /* Add responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                margin-top: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            .button {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <h2>User List</h2>
        <a href="add_user.php" class="button">Add New User</a>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['username']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . $row['created_at'] . "</td>
                                <td class='actions'>
                                    <a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | 
                                    <a href='manage_users.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

