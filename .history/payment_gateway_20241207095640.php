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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            text-align:center;
            padding: 0;
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #4CAF50;
        }
        .message {
            color: #28a745;
            font-weight: bold;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        button, .home-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover, .home-button:hover {
            background-color: #45a049;
        }
        .cart-container {
            margin-top: 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
        }
        .total-price {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Gateway</h1>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <h2>Available Courses</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Price (USD)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="add_to_cart">Add to Cart</button </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No courses available</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="cart-container">
            <h2>Your Cart</h2>
            <ul>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $course_id): ?>
                        <?php
                        $course_query = $conn->query("SELECT title, price FROM courses WHERE id = $course_id");
                        $course = $course_query->fetch_assoc();
                        ?>
                        <li class="cart-item" data-price="<?php echo htmlspecialchars($course['price']); ?>">
                            <span><?php echo htmlspecialchars($course['title']); ?></span>
                            <span><?php echo htmlspecialchars($course['price']); ?> USD</span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Your cart is empty.</li>
                <?php endif; ?>
            </ul>
            <h3 class="total-price">Total Price: <span id="total-price">0.00 USD</span></h3>
            <form method="POST">
                <button type="submit" name="pay">Proceed to Pay</button>
            </form>
        </div>
    </div>
    <a href="index.html" class="home-button">Home</a>
    <script>
        function updateTotal() {
            const cartItems = document.querySelectorAll('.cart-item');
            let total = 0;

            cartItems.forEach(item => {
                const price = parseFloat(item.getAttribute('data-price'));
                total += price;
            });

            document.getElementById('total-price').innerText = total.toFixed(2) + ' USD';
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateTotal();
        });
    </script>
</body>
</html>