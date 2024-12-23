<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #000000, #444444);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #1a1a1a;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        .login-container .icon {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff6600;
            color: white;
            border-radius: 50%;
            padding: 15px;
            font-size: 2.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #ff6600;
            font-size: 1.8rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        label {
            font-weight: 500;
            color: #aaaaaa;
        }

        .input-container {
            position: relative;
        }

        .input-container input,
        .input-container textarea {
            width: 100%;
            padding: 0.75rem 2.5rem;
            border: 1px solid #444444;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #333333;
            color: #ffffff;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #ff6600;
            font-size: 1.2rem;
        }

        .input-container textarea {
            resize: none; /* Prevent resizing */
            height: 100px; /* Set a fixed height */
        }

        button {
            padding: 0.75rem;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #e65c00;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h1>Admin Login</h1>
        <form action="admin_authenticate.php" method="POST">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
