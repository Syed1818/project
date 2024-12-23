<?php
include 'connect.php';

$message = "";

// Fetch course options
$course_query = "SELECT id, title FROM courses";
$course_result = $conn->query($course_query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $price = $_POST['price'];
    $sale_date = date('Y-m-d H:i:s'); // Current timestamp

    if ($course_id && $price) {
        $stmt = $conn->prepare("INSERT INTO sales (course_id, price, sale_date) VALUES (?, ?, ?)");
        $stmt->bind_param("ids", $course_id, $price, $sale_date);
        if ($stmt->execute()) {
            $message = "Sale record added successfully!";
        } else {
            $message = "Error adding sale: " . $conn->error;
        }
        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            color: #28a745;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Sale</h1>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="course_id">Course</label>
            <select name="course_id" id="course_id" required>
                <option value="">-- Select Course --</option>
                <?php if ($course_result && $course_result->num_rows > 0): ?>
                    <?php while ($course = $course_result->fetch_assoc()): ?>
                        <option value="<?php echo $course['id']; ?>">
                            <?php echo htmlspecialchars($course['title']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">No courses available</option>
                <?php endif; ?>
            </select>

            <label for="price">Price (USD)</label>
            <input type="number" name="price" id="price" step="0.01" min="0" required>

            <button type="submit">Add Sale</button>
        </form>
    </div>
</body>
</html>
