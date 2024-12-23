<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Progress Tracker</title>
</head>
<body>
    <header>
        <h1>Your Progress</h1>
    </header>
    <main>
        <section>
            <h2>Course Progress</h2>
            <?php include 'php/fetch-progress.php'; ?>
        </section>
    </main>
</body>
</html>
