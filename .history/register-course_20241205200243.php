<?php
include 'connect.php'; // Make sure the path is correct
session_start();
// Fetch courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #fff;
    background-image: url('images/bg1.jpg'); /* Use your relative path */
    background-size: cover; /* Ensures the image covers the entire screen */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the background static during scrolling */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    text-align: center;
    position: relative; /* To allow overlays or additional styling */
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Add a semi-transparent overlay for better text visibility */
    z-index: -1; /* Places the overlay behind the content */
}

        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        main {
            padding: 2rem;
        }

        form {
            background: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin: 0.5rem 0 0.2rem;
        }
        form select {
            font-size: 1rem; /* Adjust size as needed */
        }

        form select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff; /* White background for visibility */
            color: #000; /* Black text color for contrast */
        }

        form select option {
            background-color: #fff; /* White background for dropdown options */
            color: #000; /* Black text color */
        }

        form input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
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
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background:#4CAF50;
            color: #fff;
            margin: 0.5rem 0;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 1rem;
        }

        nav a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #45a049;
        }
        .home-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .home-button:hover {
            background-color: #0056b3;
        }

    </style>
    <title>Register for Courses</title>
</head>
<body>
    <header>
        <h1>Course Registration</h1>
    </header>
    <main>
        <h2>Register for Courses</h2>
        <form action="payment_gateway.php" method="POST">
    <label for="course_id">Choose a course:</label>
    <select id="course_id" name="course_id" required>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</option>";
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
