<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\User;

session_start();

// Redirect if already logged in
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = new User();
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($first_name && $last_name && $username && $password) {
        $registered = $user->register([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'password' => $password,
        ]);

        if ($registered) {
            $message = "✅ You have successfully registered! You may now <a href='login.php'>login</a>.";
        } else {
            $message = "❌ Registration failed. Username may already be taken.";
        }
    } else {
        $message = "⚠️ All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .message {
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        .message a {
            color:rgb(219, 225, 230);
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        input[type="submit"] {
            background-color:rgb(0, 0, 0);
            color: white;
            cursor: pointer;
            border: none;
        }
        a{
            color: white;
            background: black;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            font-size: 12;
        }

        input[type="submit"]:hover {
            background-color:rgb(0, 0, 0);
        }


    </style>
</head>
<body>
    <form method="POST" action="register.php">
        <h1>Register</h1>

        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" required>
        <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" required>
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Register">
        <a href = "login.php" > Login </a>
    </form>
</body>
</html>
