<?php
include 'connect.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Do not hash the password, store it as plain text
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Removed this line

    try {
        // Use a prepared statement to prevent SQL injection
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql); // Prepare the SQL statement

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters to the statement
        $stmt->bind_param('sss', $username, $email, $password); // Use the plain text password

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Catch and display errors
        die("Error: " . $e->getMessage());
    }
}

// Optional: Close the connection when done
$conn->close();
?>