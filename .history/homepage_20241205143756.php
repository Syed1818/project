<?php
session_start();

// Check if the user is already logged in (optional)
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php"); // Redirect to Admin Dashboard if logged in
    exit();
} elseif (isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php"); // Redirect to User Dashboard if logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Homepage</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(120deg, #f6d365, #fda085);
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
            font-size: 1.1rem;
            width: 100%;
            max-width: 300px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 16px;
            color: #333;
        }

        .note {
            color: #777;
            font-size: 14px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to E-Learning Platform</h1>
        <p>Select your login type:</p>
        <a href="admin_login.php" class="button">Admin Login</a>
        <a href="login.html" class="button">User Login</a>

        <p class="note">Not a member? <a href="#">Sign up</a> for free!</p>
    </div>

</body>
</html>