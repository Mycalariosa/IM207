<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\User;

session_start();

// Redirect to index if already logged in
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = new User();
$message = '';

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $user_info = $user->login(['username' => $username]);

        if ($user_info && password_verify($password, $user_info['password'])) {
            $_SESSION['user'] = $user_info;
            header('Location: index.php');
            exit;
        } else {
            $message = 'Invalid username or password';
        }
    } else {
        $message = 'Both fields are required';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        * {
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }
        body {
            background: #f4f4f4;
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
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        .button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background: black;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .button:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <form method="POST" action="login.php">
        <h1>Login</h1>
        <?php if (!empty($message)): ?>
            <div class="error"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="submit" class="button">Submit</button>
        <a href="register.php" class="button">Register</a>
    </form>
</body>
</html>
