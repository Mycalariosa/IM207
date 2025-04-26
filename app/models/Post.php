<?php

namespace Aries\Dbmodel\Models;

use Aries\Dbmodel\Includes\Database;

class Post extends Database {
    private $db;

    public function __construct() {
        parent::__construct(); // Call the parent constructor to establish the connection
        $this->db = $this->getConnection(); // Get the connection instance
    }

    // Fetch all posts
    public function getPosts() {
        $sql = "SELECT * FROM posts ORDER BY date_posted DESC"; // Order by date_posted
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch posts by a specific user
    public function getPostsByLoggedInUser($id) {
        $sql = "SELECT * FROM posts WHERE author_id = :id ORDER BY date_posted DESC"; // Order by date_posted
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Add a new post
    public function addPost($data) {
        $sql = "INSERT INTO posts (title, content, author_id, date_posted) 
                VALUES (:title, :content, :author_id, NOW())"; // Use NOW() for the current timestamp
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'author_id' => $data['author_id']
        ]);

        header('Location: index.php');
        exit;
    }
    // Fetch a post by ID
public function getPostById($post_id) {
    $sql = "SELECT * FROM posts WHERE post_id = :post_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'post_id' => $post_id
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


    // Update a post
    public function updatePost($data) {
        $sql = "UPDATE posts SET title = :title, content = :content WHERE post_id = :post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'post_id' => $data['post_id']
        ]);
        return "Post updated successfully!";
    }

    // Delete a post
    public function deletePost($post_id) {
        $sql = "DELETE FROM posts WHERE post_id = :post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'post_id' => $post_id
        ]);
        return "Post deleted successfully!";
        
    }
}
