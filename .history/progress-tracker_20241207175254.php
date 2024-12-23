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
            background: linear-gradient(120deg, #ff7f50, #ff4500); /* Orange gradient background */
            color: #f4f4f4; /* Light text for contrast */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styling */
        .header {
            background-color: #333; /* Dark background for header */
            color: #ff7f50; /* Orange text */
            padding: 1rem;
            text-align: center;
            border-bottom: 5px solid #ff4500; /* Orange bottom border */
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
            background: transparent; /* Semi-transparent black background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .progress-section h2 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
            color: black; /* Orange text for section titles */
        }

        /* Progress List Styling */
        .progress-container ul {
            list-style: none;
            padding: 0;
        }

        .progress-container li {
            background: #333; /* Dark background for progress items */
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
            color: #ff7f50; /* Orange color for course names */
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
            background-color: #ff7f50; /* Orange progress bar */
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
            background-color: #ff4500; /* Orange button */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #ff6347; /* Lighter orange on hover */
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
