<?php
include 'connect.php';

// Fetch course sales data
$sales_query = "
    SELECT 
        courses.title AS course_title,
        COUNT(sales.course_id) AS total_sold,
        SUM(sales.price) AS total_revenue,
        (SELECT COUNT(*) FROM enrollments WHERE enrollments.course_id = courses.id) AS total_enrollments
    FROM courses
    LEFT JOIN sales ON sales.course_id = courses.id
    GROUP BY courses.id;
";
$sales_result = $conn->query($sales_query);

// Fetch total sales, revenue, and enrollments
$total_query = "
    SELECT 
        COUNT(DISTINCT sales.id) AS total_sales,
        SUM(sales.price) AS total_revenue,
        COUNT(DISTINCT enrollments.id) AS total_enrollments
    FROM sales
    LEFT JOIN enrollments ON enrollments.course_id = sales.course_id;
";
$total_result = $conn->query($total_query);
$total_data = $total_result->fetch_assoc();
$total_sales = $total_data['total_sales'] ?? 0;
$total_revenue = $total_data['total_revenue'] ?? 0;
$total_enrollments = $total_data['total_enrollments'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        /* Add your existing styles here */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1c1c1c;
            color: #f1f1f1;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px 30px;
            background: #2a2a2a;
            border-radius: 15px;
        }
        h1, h2 {
            text-align: center;
            color: #ff7f00;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background: #333;
            border-radius: 10px;
            padding: 20px;
        }
        .stat-card {
            text-align: center;
            color: #ccc;
        }
        .stat-card h3 {
            color: #ff7f00;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 15px;
            border-bottom: 1px solid #444;
        }
        th {
            background: #ff7f00;
            color: #1c1c1c;
        }
        tr:hover {
            background: #333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Report</h1>
        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $total_enrollments; ?></h3>
                <p>Total Enrollments</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $total_sales; ?></h3>
                <p>Total Sales</p>
            </div>
            <div class="stat-card">
                <h3><?php echo number_format($total_revenue, 2); ?> USD</h3>
                <p>Total Revenue</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Enrollments</th>
                    <th>Units Sold</th>
                    <th>Revenue (USD)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($sales_result->num_rows > 0): ?>
                    <?php while ($row = $sales_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                            <td><?php echo $row['total_enrollments']; ?></td>
                            <td><?php echo $row['total_sold']; ?></td>
                            <td><?php echo number_format($row['total_revenue'], 2); ?> USD</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No sales or enrollment data available.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="footer">&copy; 2024 Professional Sales. All rights reserved.</div>
</body>
</html>
