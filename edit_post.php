<?php
require_once 'vendor/autoload.php';
use Aries\Dbmodel\Models\Post;

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$post = new Post();

// Fetch the post to be edited based on the post_id passed in the URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $post_data = $post->getPostById($post_id); // Method to fetch a post by ID
    if (!$post_data) {
        echo "Post not found!";
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Update the post
    $post->updatePost([
        'post_id' => $post_id,
        'title' => $title,
        'content' => $content
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <style>
        body { background-color: #fff; font-family: 'Segoe UI'; margin: 0; padding: 40px 20px; }
        .container { max-width: 700px; margin: auto; background-color: #f7f7f7; padding: 30px; border-radius: 10px; }
        h1 { text-align: center; margin-bottom: 25px; }
        form { display: flex; flex-direction: column; gap: 15px; }
        input[type="text"], textarea { padding: 12px; font-size: 16px; border: 1px solid #ddd; border-radius: 6px; }
        textarea { height: 200px; resize: vertical; }
        .button { background-color: #000; color: #fff; padding: 12px; font-size: 16px; border: none; border-radius: 6px; cursor: pointer; }
        .button:hover { background-color: #333; }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #000; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Blog Post</h1>

    <form action="edit_post.php?post_id=<?php echo $post_id; ?>" method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post_data['title']); ?>" required placeholder="Enter blog title"><br><br>
        
        <textarea name="content" required placeholder="Write your blog content here..."><?php echo htmlspecialchars($post_data['content']); ?></textarea><br><br>
        
        <button type="submit" class="button">Update Post</button>
    </form>

    <div class="back-link">
        <a href="index.php">← Back to Blog</a>
    </div>
</div>

</body>
</html>
