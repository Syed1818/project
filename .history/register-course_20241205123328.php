<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 2rem;
        }

        select {
            width: 50%;
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 1rem;
            font-size: 1rem;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Select a Course</h1>
    <form id="courseForm">
        <label for="course">Choose a course:</label>
        <select id="course" name="course" required>
            <!-- Options will be dynamically added here -->
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
    <div class="message" id="message"></div>

    <script>
        // Fetch courses from the server
        fetch('get_course.php')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.getElementById('course');
                data.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.id; // Use the course ID as the value
                    option.textContent = course.name; // Display the course name
                    selectElement.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching courses:', error);
            });

        // Handle form submission
        document.getElementById('courseForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedCourse = document.getElementById('course').value;
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = `You have successfully selected course ID: ${selectedCourse}`;
        });
    </script>
</body>
</html>
