<?php
include('config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please login first.";
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "SELECT * FROM posts WHERE id=$id AND user_id=" . $_SESSION['user_id'];
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found or you are not authorized to edit it.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $update = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    if ($conn->query($update)) {
        echo "Post updated successfully. <a href='view_posts.php'>View Posts</a>";
    } else {
        echo "Error updating post: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
<h2>Edit Post</h2>
<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="5" cols="40" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

    <input type="submit" value="Update Post">
</form>
</body>
</html>