<?php
require_once 'vendor/autoload.php';
use Aries\Dbmodel\Models\Post;
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$post = new Post();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $post->create([
            'user_id' => $_SESSION['user']['id'],
            'title' => $title,
            'content' => $content
        ]);
        header('Location: index.php');
        exit;
    } else {
        $message = '⚠️ Please fill all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
</head>
<body>

<h2>Create New Blog Post</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required><br><br>
    <textarea name="content" placeholder="Content" rows="6" required></textarea><br><br>
    <button type="submit">Post</button>
</form>

<a href="index.php">Back to Home</a>

</body>
</html>
