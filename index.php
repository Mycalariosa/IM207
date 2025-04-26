<?php
require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\Post;

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$post = new Post();
$posts = $post->getPostsByLoggedInUser($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .topbar {
            background-color: #000;
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .logout button {
            background-color: #000;
            color: white;
            border: none;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout button:hover {
            background-color: #333;
        }
        .sidebar {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }
        .divider {
            height: 1px;
            background: #000;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="topbar">
    Mica's Blog Platform
</div>

<div class="container py-4">
    <div class="d-flex justify-content-end mb-3 logout">
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-3">Welcome to Your Blog!</h1>
            <h5>Hello, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?>!</h5>

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                            <!-- Edit and Delete buttons are removed -->
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No posts found. Click the button to create one!</p>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="sidebar mb-4 text-center">
                <h5>Search</h5>
                <form class="d-flex mb-3" action="#" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-dark" type="submit">Go!</button>
                </form>
            </div>

            <div class="divider"></div> <!-- Black line divider -->

            <div class="sidebar text-center">
                <h5>Create a New Post</h5>
                <p>Start sharing your thoughts and stories.</p>
                <a href="blog.php" class="btn btn-dark">+ New Post</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  
