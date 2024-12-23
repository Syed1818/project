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
        $stmt = $conn->prepare("INSERT INTO sales (course_id, price) VALUES (?, ?)");
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
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1 {
            font-size: 2rem;
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }
        button {
            padding: 12px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            font-size: 1rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 20px;
            text-align: center;
        }
        .icon {
            margin-right: 10px;
            color: #4CAF50;
        }
        .back-link {
            position: absolute;
            top: -40px;
            left: 20px;
            text-decoration: none;
            font-size: 1.2rem;
            color: #4CAF50;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-link"><i class="fas fa-arrow-left icon"></i>Back</a>
    <div class="container">
        <h1><i class="fas fa-chart-line icon"></i>Add Sale</h1>
        <?php if ($message): ?>
            <p class="message"><i class="fas fa-check-circle icon"></i><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" id="saleForm">
            <label for="course_id"><i class="fas fa-book icon"></i>Course</label>
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

            <label for="price"><i class="fas fa-dollar-sign icon"></i>Price (USD)</label>
            <input type="number" name="price" id="price" step="0.01" min="0" readonly required>

            <button type="submit"><i class="fas fa-plus-circle icon"></i>Add Sale</button>
        </form>
    </div>
    <div class="footer">
        &copy; 2024 Professional Sales. All rights reserved.
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#course_id').change(function () {
                const courseId = $(this).val();
                if (courseId) {
                    $.ajax({
                        url: 'get_course_price.php',
                        type: 'GET',
                        data: { course_id: courseId },
                        success: function (data) {
                            $('#price').val(data);
                        },
                        error: function () {
                            alert('Error fetching course price');
                        }
                    });
                } else {
                    $('#price').val('');
                }
            });
        });
    </script>
</body>
</html>
