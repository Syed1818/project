<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Initialize cart and message
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$message = "";

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $course_id = $_POST['course_id'];
    if (!in_array($course_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $course_id;
        $message = "Course added to cart successfully!";
    } else {
        $message = "Course is already in the cart!";
    }
}

// Handle removing from cart
if (isset($_POST['remove_from_cart'])) {
    $course_id = $_POST['course_id'];
    if (($key = array_search($course_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $message = "Course removed from cart.";
    }
}

// Handle payment processing
if (isset($_POST['pay'])) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $course_id) {
            $user_id = $_SESSION['user_id'];
            $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $course_id);
            $stmt->execute();
            $stmt->close();
        }
        $_SESSION['cart'] = [];
        $message = "Payment successful! You are now enrolled in the courses.";
    } else {
        $message = "Your cart is empty!";
    }
}

// Fetch available courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Initialize cart and message
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$message = "";

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $course_id = $_POST['course_id'];
    if (!in_array($course_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $course_id;
        $message = "Course added to cart successfully!";
    } else {
        $message = "Course is already in the cart!";
    }
}

// Handle removing from cart
if (isset($_POST['remove_from_cart'])) {
    $course_id = $_POST['course_id'];
    if (($key = array_search($course_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $message = "Course removed from cart.";
    }
}

// Handle payment processing
if (isset($_POST['pay'])) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $course_id) {
            $user_id = $_SESSION['user_id'];
            $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $course_id);
            $stmt->execute();
            $stmt->close();
        }
        $_SESSION['cart'] = [];
        $message = "Payment successful! You are now enrolled in the courses.";
    } else {
        $message = "Your cart is empty!";
    }
}

// Fetch available courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #f2f2f2; /* Light text color for better contrast */
        }

        .header {
            background-color: #333; /* Dark background */
            color: #FFA500; /* Orange color */
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #333; /* Dark background for container */
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #FFA500; /* Orange color for headers */
            margin-bottom: 20px;
            font-size: 1.8rem;
            text-align: center;
        }

        .message {
            color: #28a745;
            font-weight: 500;
            text-align: center;
            margin: 10px 0;
        }

        .course-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: #444; /* Dark background for course card */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-card h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #f2f2f2; /* Light text color */
        }

        .course-card span {
            font-size: 1rem;
            color: #f2f2f2; /* Light text color */
        }

        .course-card button {
            background-color: #FFA500; /* Orange button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .course-card button:hover {
            background-color: #e68900; /* Darker orange on hover */
        }

        .cart-container {
            margin-top: 30px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            color: #f2f2f2; /* Light text color */
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .total-price {
            font-size: 1.4rem;
            font-weight: 600;
            text-align: right;
            margin-top: 20px;
            color: #f2f2f2; /* Light text color */
        }

        .btn-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn-container button {
            background-color: #FFA500; /* Orange button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .btn-container button:hover {
            background-color: #e68900; /* Darker orange on hover */
        }

        .home-button {
            display: inline-block;
            margin: 10px auto;
            background-color: #f44336; /* Red for home button */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            text-align: center;
        }

        .home-button:hover {
            background-color: #e53935; /* Darker red on hover */
        }

        .footer {
            background-color: #333; /* Dark background */
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="header">Payment Gateway</div>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <h2>Available Courses</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="course-card">
                    <div>
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <span>$<?php echo htmlspecialchars($row['price']); ?></span>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No courses available</p>
        <?php endif; ?>

        <div class="cart-container">
            <h2>Your Cart</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul>
                    <?php $total_price = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $course_id): ?>
                        <?php
                        $course_query = $conn->query("SELECT title, price FROM courses WHERE id = $course_id");
                        $course = $course_query->fetch_assoc();
                        $total_price += $course['price'];
                        ?>
                        <li class="cart-item">
                            <span><?php echo htmlspecialchars($course['title']); ?></span>
                            <span>$<?php echo htmlspecialchars($course['price']); ?></span>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                <button type="submit" name="remove_from_cart" style="background-color:#f44336; color:white; padding:5px 10px; border:none; border-radius:3px; cursor:pointer;">Remove</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="total-price">Total: $<?php echo number_format($total_price, 2); ?></div>
                <div class="btn-container">
                    <form method="POST">
                        <button type="submit" name="pay">Proceed to Pay</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
        <a href="index.html" class="home-button">Home</a>
    </div>
    <div class="footer">
        &copy; 2024 Payment Gateway. All rights reserved.
    </div>
</body>
</html>
