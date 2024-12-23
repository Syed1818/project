<?php
session_start();

// Check if an admin session exists
if (isset($_SESSION['admin_id'])) {
    // Destroy the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
}

// Redirect to the admin login page
header("Location:homepage.php");
exit();
?>
