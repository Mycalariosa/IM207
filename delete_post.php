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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the post_id
    if (isset($_POST['post_id']) && is_numeric($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Call the delete method and ensure it succeeds
        if ($post->deletePost($post_id)) {
            // Redirect to index page after successful deletion
            header('Location: index.php');
            exit;
        } else {
            // If deletion fails, you can redirect to index with an error message
            header('Location: index.php?error=1');
            exit;
        }
    } else {
        // Invalid post_id
        header('Location: index.php?error=1');
        exit;
    }
}

// If no POST request, redirect to index page (this is a safety measure)
header('Location: index.php');
exit;
