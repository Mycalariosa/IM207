<?php
require_once 'vendor/autoload.php';
use Aries\Dbmodel\Models\Post;
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$post = new Post();
$id = (int) ($_GET['id'] ?? 0);
$blog = $post->getPostById($id);

// Check if the post belongs to logged-in user
if (!$blog || $blog['user_id'] != $_SESSION['user']['id']) {
    header('Location: index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $post->update($id, [
            'title' => $title,
            'content' => $content
        ]);
        header('Location: index.php');
        exit;
    } else {
        $message = '⚠️ Fill all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
</head>
<body>

<h2>Edit Blog Post</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required><br><br>
    <textarea name="content" rows="6" required><?php echo htmlspecialchars($blog['content']); ?></textarea><br><br>
    <button type="submit">Save Changes</button>
</form>

<a href="index.php">Back to Home</a>

</body>
</html>
