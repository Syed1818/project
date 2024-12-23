<?php
$host = '127.0.0.1'; // Database host (localhost in most cases)
$db = 'elearning'; // Your database name
$user = 'myadmin'; // MySQL username (default: root)
$pass = 'syedshahid@123'; // MySQL password (default: empty)

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle the connection error
    die("Connection failed: " . $e->getMessage());
}
?>
