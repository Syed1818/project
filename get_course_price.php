<?php
include 'connect.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $stmt = $conn->prepare("SELECT price FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    echo $price;
    exit;
}
?>
