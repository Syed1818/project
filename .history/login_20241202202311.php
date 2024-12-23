<?php
session_start();
include 'connect.php'; // Ensure this path is correct

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare statement to prevent SQL injection
        if ($conn) { // Check if $conn is defined
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User found
                $user = $result->fetch_assoc();
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.html");
                exit();
            } else {
                echo "Invalid email or password.";
            }

            $stmt->close();
        } else {
            echo "Database connection failed.";
        }
    } else {
        echo "Email and password are required.";
    }
}
?>
