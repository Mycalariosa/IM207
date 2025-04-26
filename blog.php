<?php
require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\Post;

session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$post = new Post();

$title = '';
$content = '';
$editing = false;

// Check if editing an existing post
if (isset($_GET['edit'])) {
    $postId = $_GET['edit'];
    $existingPost = $post->getPostById($postId);

    if ($existingPost && $existingPost['author_id'] == $_SESSION['user']['id']) {
        $title = $existingPost['title'];
        $content = $existingPost['content'];
        $editing = true;
    } else {
        header("Location: index.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content']),
        'author_id' => $_SESSION['user']['id']
    ];

    if (!empty($_POST['post_id'])) {
        $post->updatePost($_POST['post_id'], $data);
    } else {
        $post->addPost($data);
    }

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $editing ? 'Edit' : 'Create'; ?> Blog Post</title>
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
    <h1><?php echo $editing ? 'Edit' : 'Create'; ?> a Blog Post</h1>

    <form method="POST" action="">
        <input type="hidden" name="post_id" value="<?php echo $editing ? htmlspecialchars($_GET['edit']) : ''; ?>">
        <input type="text" name="title" placeholder="Enter blog title" value="<?php echo htmlspecialchars($title); ?>" required>
        <textarea name="content" placeholder="Write your blog content here..." required><?php echo htmlspecialchars($content); ?></textarea>
        <input type="submit" class="button" name="submit" value="<?php echo $editing ? 'Update Post' : 'Submit Post'; ?>">
    </form>

    <div class="back-link">
        <a href="index.php">← Back to Blog</a>
    </div>
</div>

</body>
</html>
