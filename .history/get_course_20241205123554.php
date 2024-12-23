<?php
include 'connect.php';

// Fetch courses from the database
$sql = "SELECT course_name FROM courses";
$result = $conn->query($sql);

$courses = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = ['name' => $row['course_name']]; // Use an associative array with 'name' as the key
    }
}

// Set header to JSON and return the data
header('Content-Type: application/json');
echo json_encode($courses);
?>
