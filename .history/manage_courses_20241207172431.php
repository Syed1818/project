<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connect.php';

// Handle course deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM courses WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_courses.php");
    exit();
}

// Fetch courses for display
$sql = "SELECT id, title FROM courses"; // Adjust column names based on your table structure
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #1c1c1c; /* Black background */
            color: #f1f1f1; /* Light text */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100vh;
        }

        .container {
            background: #2a2a2a; /* Dark background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 900px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #ff7f00; /* Orange */
            font-size: 2.5rem;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #f1f1f1; /* Light text */
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #ff7f00; /* Orange */
            color: #1c1c1c; /* Black text */
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #e56d00; /* Darker orange */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #444; /* Darker divider */
        }

        th {
            background-color: #ff7f00; /* Orange */
            color: #1c1c1c; /* Black text */
        }

        tr:hover {
            background-color: #3a3a3a; /* Lighter dark hover */
        }

        a {
            color: #ff7f00; /* Orange links */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            color: #e56d00; /* Darker orange for delete link */
            text-decoration: none;
        }

        .actions a:hover {
            color: #ff4500; /* Red-orange on hover */
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .container {
                padding: 15px;
            }

            .button {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            table th, table td {
                font-size: 0.9rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Courses</h1>
        </header>

        <main>
            <h2>Course List</h2>
            <a href="add_course.php" class="button">Add New Course</a>

            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['title']) . "</td>
                                    <td class='actions'>
                                        <a href='edit_course.php?id=" . $row['id'] . "'>Edit</a> | 
                                        <a href='manage_courses.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>
                                    </td>
                                    </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No courses found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
