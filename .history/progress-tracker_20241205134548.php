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
    <title>Progress Tracker</title>
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(120deg, #f6d365, #fda085);
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header Styling */
.header {
    background-color: #4CAF50;
    color: white;
    padding: 1rem;
    text-align: center;
    border-bottom: 5px solid #3e8e41;
}

.header h1 {
    font-size: 2rem;
    font-weight: bold;
}

/* Section Styling */
.progress-section {
    margin: 2rem auto;
    padding: 1rem;
    max-width: 800px;
    background: #ffffffaa;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.progress-section h2 {
    font-size: 1.5rem;
    text-align: center;
    margin-bottom: 1rem;
    color: #4CAF50;
}

/* Progress List Styling */
.progress-container ul {
    list-style: none;
    padding: 0;
}

.progress-container li {
    background: #fff;
    margin: 0.8rem 0;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.progress-container strong {
    font-size: 1.2rem;
    color: #333;
}

.progress-container form {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

/* Progress Bar */
.progress-bar {
    width: 100%;
    background: #e0e0e0;
    border-radius: 20px;
    height: 15px;
    position: relative;
    overflow: hidden;
}

.progress-bar span {
    display: block;
    height: 100%;
    background-color: #4CAF50;
    width: 0;
    border-radius: 20px;
    transition: width 0.4s ease-in-out;
}

/* Inputs and Buttons */
input[type="number"] {
    width: 60px;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <header class="header">
        <h1>📚 Your Learning Progress</h1>
    </header>
    <main>
        <section class="progress-section">
            <h2>Your Course Progress</h2>
            <div class="progress-container">
                <?php include 'fetch_progress.php'; ?>
            </div>
        </section>
    </main>
</body>
</html>
