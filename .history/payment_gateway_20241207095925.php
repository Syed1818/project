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
            color: #333;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #4CAF50;
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
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-card h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .course-card span {
            font-size: 1rem;
            color: #666;
        }

        .course-card button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .course-card button:hover {
            background-color: #45a049;
        }

        .cart-container {
            margin-top: 30px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .total-price {
            font-size: 1.4rem;
            font-weight: 600;
            text-align: right;
            margin-top: 20px;
            color: #333;
        }

        .btn-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .btn-container button:hover {
            background-color: #45a049;
        }

        .home-button {
            display: inline-block;
            margin-top: 10px;
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .home-button:hover {
            background-color: #e53935;
        }

        .footer {
            background-color: #4CAF50;
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
