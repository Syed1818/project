<?php
include('connect.php'); // Include the database connection

// Fetch only 3 courses from the database
$stmt = $conn->prepare("SELECT * FROM Courses LIMIT 3"); // Limit to 3 courses
$stmt->execute(); // Execute the statement

// Get the result
$result = $stmt->get_result(); // Get the result set from the prepared statement

// Fetch all courses
$courses = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array

// Optional: Close the statement
$stmt->close();

// Optional: Close the connection
$conn->close();
?>