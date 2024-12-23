<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connect.php';

// Fetch course details based on the ID
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $sql = "SELECT title FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $course = $result->fetch_assoc();
    } else {
        echo "Course not found!";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid course ID!";
    exit();
}

// Handle form submission for course update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title = $_POST['title'];

    $update_sql = "UPDATE courses SET title = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $new_title, $course_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_courses.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
            font-size: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Course</h1>
        <form action="edit_course.php?id=<?php echo htmlspecialchars($course_id); ?>" method="POST">
            <label for="title">Course Title</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
            <button type="submit">Update Course</button>
        </form>
    </div>
</body>
</html>
