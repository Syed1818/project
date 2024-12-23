<?php
include('connect.php'); // Include your database connection

// Fetch all courses from the database
$stmt = $conn->prepare("SELECT * FROM Courses"); // Prepare the SQL statement
$stmt->execute(); // Execute the statement

// Get the result
$result = $stmt->get_result(); // Get the result set from the prepared statement

// Fetch all courses as an associative array
$courses = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array

// Optional: Close the statement
$stmt->close();

// Optional: Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styling with background image */
    body {
        font-family: 'Arial', sans-serif;
        background-image: url('https://wallpaperboat.com/wp-content/uploads/2019/10/free-website-background-21.jpg'); /* Use your image path here */
        background-size: cover; /* Ensure the image covers the whole page */
        background-position: center; /* Center the image */
        background-attachment: fixed; /* Keep the background fixed while scrolling */
        color: #333;
        line-height: 1.6;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4); /* Black overlay with 40% opacity */
        z-index: -1;
    }

    h1 {
        text-align: center;
        font-size: 2.5em;
        margin-top: 40px;
        color: #4CAF50;
        text-transform: uppercase;
    }

    /* Container to hold the courses */
    .courses-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Auto responsive grid */
        gap: 30px;
        padding: 20px;
    }

    /* Each individual course item */
    .course-item {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        overflow: hidden;
    }

    /* Hover effect on each course card */
    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }

    /* Make images responsive and fit within the container */
    .course-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    /* Hover effect for images */
    .course-item:hover img {
        transform: scale(1.1);
    }

    /* Course name styling */
    .course-item h3 {
        font-size: 1.3em;
        color: #333;
        margin-top: 15px;
        text-transform: capitalize;
    }

    /* Course description styling */
    .course-item p {
        font-size: 0.9em;
        color: #666;
        margin-top: 10px;
    }

    .course-item p strong {
        color: #333;
    }

    /* Instructor info styling */
    .instructor-info {
        font-size: 1em;
        color: #4CAF50;
        margin-top: 10px;
        font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .courses-container {
            grid-template-columns: 1fr 1fr; /* Two columns for smaller screens */
        }
    }

    @media (max-width: 480px) {
        .courses-container {
            grid-template-columns: 1fr; /* Single column for mobile screens */
        }

        h1 {
            font-size: 2em;
        }
    }
    h1 {
        font-family: 'Arial', sans-serif; /* Change font style to Arial */
        color: white; /* Change font color to Tomato red */
        text-align: center; /* Center the title */
        font-size: 2.5em; /* Adjust the font size */
        margin-top: 40px; /* Add space at the top */
    }
</style>
<body>

    <h1>Available Courses</h1>

    <!-- Course List -->
    <div class="courses-container">
        <?php foreach ($courses as $course): ?>
            <div class="course-item">
                <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="Course Image">
                <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                <p><?php echo htmlspecialchars($course['description']); ?></p>
                <p class="instructor-info"><strong>Instructor Id:</strong> <?php echo htmlspecialchars($course['instructor_id']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
