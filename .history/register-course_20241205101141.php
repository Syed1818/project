<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Initialize variables
$message = "";

// Handle course registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $user_id = $_SESSION['user_id'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $course_id);

    if ($stmt->execute()) {
        $message = "You have successfully registered for the course.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch courses
$sql = "SELECT id, title FROM course";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching courses: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Include your previous CSS styles */
    </style>
    <title>Register for Courses</title>
</head>
<body>
    <header>
        <h1>Course Registration</h1>
    </header>
    <main>
        <h2>Register for Courses</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register-course.php" method="POST">
            <label for="course_id">Choose a course:</label>
            <select id="course_id" name="course_id" required>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['title']) . "</option>";
                    }
                } else {
                    echo "<option disabled>No courses available</option>";
                }
                ?>
            </select>
            <button type="submit">Register</button>
        </form>
    </main>
    <a href="index.html" class="home-button">Home</a> 
</body>
</html>
