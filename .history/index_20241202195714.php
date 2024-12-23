<?php
include('connect.php'); // Include the database connection

// Fetch only 3 courses from the database
$stmt = $conn->prepare("SELECT * FROM Courses LIMIT 3"); // Limit to 3 courses
$stmt->execute(); // Execute the statement

// Get the result
$result = $stmt->get_result(); // Get the result set from the prepared statement

// Fetch all courses
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
    <title>Featured Courses</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
}

header {
        background-image: url("https://thebrooksgrouponline.com/wp-content/uploads/2022/04/LX-vs-elearning.png"); /* Example placeholder image */
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
        padding: 10rem 0;
        position: relative;
        }

header h1 {
    font-size: 3rem;
    margin-bottom: 10px;
}

header p {
    font-size: 1.5rem;
    margin-top: 0;
}

/* Navigation Bar */
nav {
    background-color: #333;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 15px 0;
}

nav ul li {
    margin: 0 20px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 1.1rem;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #f4a261;
}

/* Main Content */
main {
    padding: 40px 10%;
}

/* Intro Section */
.intro {
    text-align: center;
    margin-bottom: 40px;
}

.intro h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.intro p {
    font-size: 1.2rem;
    color: #666;
}

/* CTA Buttons */
.cta-buttons {
    text-align: center;
    margin-bottom: 50px;
}

.cta-buttons a {
    background-color: #f4a261;
    color: white;
    padding: 15px 30px;
    margin: 0 10px;
    text-decoration: none;
    font-size: 1.2rem;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.cta-buttons a:hover {
    background-color: #e76f51;
}

/* Featured Courses Section */
.courses {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.course-card {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    padding: 20px;
    text-align: center;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.course-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.course-card h3 {
    font-size: 1.6rem;
    color: #333;
    margin-bottom: 10px;
}

.course-card p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 15px;
}

.course-card strong {
    color: #f4a261;
    font-weight: bold;
}

/* Footer Section */
footer {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
}

footer a {
    color: #f4a261;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

/* Media Queries for Responsiveness */
@media screen and (max-width: 768px) {
    .courses {
        grid-template-columns: repeat(2, 1fr);
    }

    .cta-buttons a {
        padding: 12px 20px;
    }

    .course-card {
        padding: 15px;
    }
}

@media screen and (max-width: 480px) {
    .courses {
        grid-template-columns: 1fr;
    }

    header h1 {
        font-size: 2.5rem;
    }

    .intro h2 {
        font-size: 2rem;
    }

    .cta-buttons a {
        font-size: 1rem;
        padding: 12px 20px;
    }
}

</style>
<body>

    <!-- Header Section with Background Image -->
    <header>
        <h1>Welcome to E-Learning</h1>
        <p>Empowering Learners, One Course at a Time</p>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="admin.html">Admin</a></li>
            <li><a href="profile.html">Profile</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <section class="intro">
            <h2>Welcome to the Future of Learning</h2>
            <p>At E-Learning, we offer a wide range of online courses to help you achieve your educational goals. Join thousands of students today and start learning at your own pace!</p>
        </section>

        <section class="cta-buttons">
            <a href="register.html">Get Started Now</a>
            <a href="courses.php">Explore More Courses</a>
        </section>

        <!-- Featured Courses Section -->
        <section class="courses">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <!-- Dynamically display the image from the database -->
                    <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="Course Image">
                    <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?>s</p> <!-- Assuming 'duration' field exists -->
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 E-Learning Platform. All Rights Reserved. | <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
        <p>Contact Us: contact@elearning.com | Phone: +91 9036445307</p>
    </footer>

</body>
</html>
