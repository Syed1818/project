<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $price = $_POST['price'];

    // Insert sales record
    $insert_query = "INSERT INTO sales (user_id, course_id, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iid", $user_id, $course_id, $price);
    if ($stmt->execute()) {
        $message = "Sale added successfully.";
    } else {
        $message = "Error adding sale: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch users and courses
$users_query = "SELECT id, username FROM users";
$courses_query = "SELECT id, title FROM courses";

$users_result = $conn->query($users_query);
$courses_result = $conn->query($courses_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sales</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1c1c1c;
            color: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #2a2a2a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px #ff7f00;
        }
        h1 {
            text-align: center;
            color: #ff7f00;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        select, input[type="number"], button {
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: #333;
            color: #f1f1f1;
        }
        button {
            background-color: #ff7f00;
            cursor: pointer;
        }
        button:hover {
            background-color: #e56d00;
        }
        .message {
            text-align: center;
            color: #e56d00;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Sales</h1>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="user_id">Select User:</label>
            <select id="user_id" name="user_id" required>
                <option value="">--Select User--</option>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></option>
                <?php endwhile; ?>
            </select>

            <label for="course_id">Select Course:</label>
            <select id="course_id" name="course_id" required>
                <option value="">--Select Course--</option>
                <?php while ($course = $courses_result->fetch_assoc()): ?>
                    <option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['title']); ?></option>
                <?php endwhile; ?>
            </select>

            <label for="price">Sale Price (USD):</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <button type="submit">Add Sale</button>
        </form>
    </div>
</body>
</html>
