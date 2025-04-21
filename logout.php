<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #2c3e50;
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
        }
        .navbar .welcome {
            font-size: 16px;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="welcome">
            Welcome, <?php echo htmlspecialchars($_SESSION['user']['first_name'] ?? 'Guest'); ?>
        </div>
        <form method="POST" action="logout.php">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <!-- Rest of your content here -->
</body>
</html>
