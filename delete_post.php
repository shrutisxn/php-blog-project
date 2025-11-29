<?php
include('config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please login first.";
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM posts WHERE id=$id AND user_id=$user_id";

    if ($conn->query($sql)) {
        echo "Post deleted successfully. <a href='view_posts.php'>View Posts</a>";
    } else {
        echo "Error deleting post: " . $conn->error;
    }
} else {
    echo "Invalid post ID.";
}
?>