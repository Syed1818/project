<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollment_id = $_POST['enrollment_id'];
    $progress = $_POST['progress'];

    $sql = "UPDATE enrollments SET progress = '$progress' WHERE id = '$enrollment_id' AND user_id = '" . $_SESSION['user_id'] . "'";
    if ($conn->query($sql) === TRUE) {
        echo "Progress updated successfully.";
    } else {
        echo "Error updating progress: " . $conn->error;
    }
}
?>
