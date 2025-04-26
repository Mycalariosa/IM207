<?php

require_once 'vendor/autoload.php';
use Aries\Dbmodel\Models\Post;

session_start();

// Check if user is logged in
$user_logged_in = isset($_SESSION['user']) && !empty($_SESSION['user']);

$post = new Post();

// If logged in, fetch only posts by the logged-in user, otherwise fetch all posts
if ($user_logged_in) {
    $posts = $post->getPostsByLoggedInUser($_SESSION['user']['id']);
} else {
    $posts = $post->getPosts(); // Fetch all posts if user is not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
        .logout, .login-btn {
            background-color: #000;
            color: white;
            border: none;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from the link */
            display: inline-block; /* Make it behave like a button */
            text-align: center;
        }
        .logout:hover, .login-btn:hover {
            background-color: #333;
        }
        .card {
            margin-bottom: 15px;
        }
        /* Custom styling for buttons */
        .btn-custom {
            background-color: #000;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #333;
        }
        /* Square Box for New Post with fixed height */
        .new-post-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            height: 300px; /* Set a fixed height */
            overflow-y: auto; /* Allow scrolling if content exceeds the fixed height */
        }
        .new-post-box h5 {
            margin-bottom: 20px;
        }
        .new-post-btn {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        /* Center the posts */
        .recent-posts {
            display: flex;
            justify-content: center;
        }
        .recent-posts .col-lg-8 {
            max-width: 900px;
        }
    </style>
</head>
<body>

<div class="topbar">
    Mica's Blog Platform
</div>

<div class="container py-4">
    <!-- If user is logged in, show logout and user posts, otherwise show login button -->
    <div class="d-flex justify-content-end mb-3">
        <?php if ($user_logged_in): ?>
            <form action="logout.php" method="POST" style="display: inline;">
                <button type="submit" class="logout">Logout</button>
            </form>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>

    <div class="row recent-posts">
        <div class="col-lg-8">
            <h1 class="mb-3"><?php echo $user_logged_in ? "Your Blog Posts" : "Recent Blog Posts"; ?></h1>
            
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                            <small class="text-muted">Posted on: <?php echo $post['date_posted']; ?></small>
                            <?php if ($user_logged_in && $_SESSION['user']['id'] == $post['author_id']): ?>
                                <!-- Edit and Delete buttons only shown if post belongs to the logged-in user -->
                                <a href="edit_post.php?post_id=<?php echo $post['post_id']; ?>" class="btn btn-custom">Edit</a>
                                <form action="delete_post.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                                    <button type="submit" class="btn btn-custom">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts available.</p>
            <?php endif; ?>
        </div>

        <!-- New Post Box, visible only if the user is logged in -->
        <?php if ($user_logged_in): ?>
            <div class="col-lg-4 new-post-box">
                <h5>Create a New Post</h5>
                <p>Start sharing your thoughts and stories.</p>
                <div class="new-post-btn">
                    <a href="blog.php" class="btn btn-dark">+ New Post</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
