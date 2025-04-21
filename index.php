<?php
session_start();

require_once 'vendor/autoload.php';
use Aries\Dbmodel\Models\Post;

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$post = new Post();
$posts = $post->getPosts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mica's Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .logout {
            text-align: right;
            margin-bottom: 20px;
        }

        .logout form {
            display: inline;
        }

        .logout button {
            background-color:rgb(12, 12, 12);
            color: white;
            border: none;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout button:hover {
            background-color:rgb(5, 5, 5);
        }

        ul {
            padding: 0;
            list-style-type: none;
        }

        li {
            padding: 15px;
            background-color: #fff;
            margin-bottom: 10px;
            border-left: 5px solid #3498db;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        .no-posts {
            text-align: center;
            color: #777;
            margin-top: 30px;
        }
        .container h1{
            align: top;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <form action="logout.php" method="POST">
                <button type="submit">Logout</button>
            </form>
        </div>

        <h1>Welcome to the Blog</h1>
        <h2>Hello, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?>!</h2>

        <ul>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <li><?php echo htmlspecialchars($post['title']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-posts">No blog posts found.</p>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
