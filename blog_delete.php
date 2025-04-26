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

// Check if the post belongs to user
if ($blog && $blog['user_id'] == $_SESSION['user']['id']) {
    $post->delete($id);
}

header('Location: index.php');
exit;
?>
