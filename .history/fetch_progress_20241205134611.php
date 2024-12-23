<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "
    SELECT enrollments.id AS enrollment_id, courses.title, enrollments.progress 
    FROM enrollments 
    INNER JOIN courses ON enrollments.course_id = courses.id 
    WHERE enrollments.user_id = '$user_id'";
$result = $conn->query($sql);

echo "<ul>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $progress = $row['progress'];
        echo "<li>
                <strong>" . htmlspecialchars($row['title']) . "</strong>
                <div class='progress-bar'>
                    <span style='width: " . $progress . "%;'></span>
                </div>
                <form action='update-progress.php' method='POST'>
                    <input type='hidden' name='enrollment_id' value='" . $row['enrollment_id'] . "'>
                    <input type='number' name='progress' min='0' max='100' value='" . $progress . "'>
                    <button type='submit'>Update</button>
                </form>
              </li>";
    }
} else {
    echo "<li>No courses enrolled yet.</li>";
}
echo "</ul>";
