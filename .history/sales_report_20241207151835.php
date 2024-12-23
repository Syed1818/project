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
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        h1 i {
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .icon {
            margin-right: 10px;
            color: #4CAF50;
        }
        .actions {
            margin-top: 20px;
            text-align: center;
        }
        .add-sales-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .add-sales-btn:hover {
            background-color: #45a049;
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
    <div class="container">
        <h1><i class="fas fa-chart-bar"></i>Sales Report</h1>
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-book icon"></i>Course Title</th>
                    <th><i class="fas fa-users icon"></i>Total Sold</th>
                    <th><i class="fas fa-dollar-sign icon"></i>Total Revenue (USD)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($sales_result && $sales_result->num_rows > 0): ?>
                    <?php while ($row = $sales_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_sold']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($row['total_revenue'], 2)); ?> USD</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No sales data available</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="actions">
            <a href="add_sales.php" class="add-sales-btn"><i class="fas fa-plus"></i> Add Sales</a>
        </div>
    </div>
    <div class="footer">
        &copy; 2024 Professional Sales. All rights reserved.
    </div>
</body>
</html>
