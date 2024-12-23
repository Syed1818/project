<?php
include 'connect.php';

// Fetch sales data
$sales_query = "
    SELECT 
        courses.title AS course_title, 
        COUNT(sales.course_id) AS total_sold, 
        SUM(sales.price) AS total_revenue 
    FROM sales 
    JOIN courses ON sales.course_id = courses.id 
    GROUP BY sales.course_id;
";
$sales_result = $conn->query($sales_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Report</h1>
        <table>
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Total Sold</th>
                    <th>Total Revenue (USD)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($sales_result && $sales_result->num_rows > 0): ?>
                    <?php while ($row = $sales_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_sold']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_revenue']); ?> USD</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No sales data available</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
