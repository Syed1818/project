<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Learning Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Header Section */
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 4rem 0;
            background-image: url("https://tse2.mm.bing.net/th?id=OIP.jY2BVa23V59tC7dhmGht-AHaDq&pid=Api&P=0&h=180"); /* Background image */
            background-size: cover;
            background-position: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            font-size: 3rem;
        }

        header p {
            font-size: 1.5rem;
        }

        /* About Section */
        .about-section {
            display: flex;
            justify-content: space-between;
            padding: 4rem 5%;
            background-color: #fff;
        }

        .about-text {
            width: 60%;
        }

        .about-text h2 {
            font-size: 2rem;
            color: #4CAF50;
            margin-bottom: 1rem;
        }

        .about-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .about-image img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: space-around;
            padding: 3rem 5%;
            background-color: #f0f0f0;
        }

        .feature {
            text-align: center;
            width: 25%;
        }

        .feature img {
            width: 80px;
            margin-bottom: 1rem;
        }

        .feature h3 {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .feature p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Footer Section */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        footer p {
            font-size: 0.9rem;
        }

        footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>About E-Learning Platform</h1>
        <p>Your journey to knowledge starts here</p>
    </header>

    <!-- About Section -->
    <section class="about-section">
        <div class="about-text">
            <h2>Welcome to E-Learning</h2>
            <p>We are a dynamic online education platform dedicated to providing high-quality courses for students of all levels. Whether you're looking to gain new skills, advance your career, or explore new subjects, our diverse range of courses has something for everyone.</p>
            <p>Our mission is to make learning accessible, engaging, and fun for everyone, no matter where they are. With experienced instructors, interactive lessons, and a community of learners, we're here to help you succeed.</p>
        </div>
        <div class="about-image">
            <?php
                // Dynamically set the image path
                $imagePath = 'https://tse4.mm.bing.net/th?id=OIP.QCKvcAHEzLangzC9MULBjwHaHa&pid=Api&P=0&h=180'; // The image URL you provided
                echo '<img src="' . htmlspecialchars($imagePath) . '" height="250px" width="250px" alt="About Us Image">';
            ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="feature">
            <img src="https://i.ibb.co/r47zkNp/list-of-courses.png" height="100px" width="400px" alt="Feature 1">
            <h3>Wide Range of Courses</h3>
            <p>From Data Science to Marketing, we offer courses in various domains that suit every learner's needs.</p>
        </div>
        <div class="feature">
            <img src="images/ins.jpg" height="100px" width="400px" alt="Feature 2"> <!-- Replace with valid URL -->
            <h3>Expert Instructors</h3>
            <p>Our courses are designed and taught by industry experts with years of practical experience.</p>
        </div>
        <div class="feature">
            <img src="C:\Users\A SARA FATHIMA\Downloads\fl.jpg" height="100px" width="400px" alt="Feature 3"> <!-- Replace with valid URL -->
            <h3>Flexible Learning</h3>
            <p>Learn at your own pace, anytime, anywhere, on any device – we put learning in your hands.</p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 E-Learning Platform. All Rights Reserved. | <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
        <p>Contact Us: contact@elearning.com | Phone: +91 9036445307</p>
    </footer>

</body>
</html>
