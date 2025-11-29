<?php
include('config.php');
session_start();

$sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
</head>
<body>
<h2>All Blog Posts</h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p><em>By " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</em></p>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        
        echo "<a href='edit_post.php?
        id={$row['id']}'>Edit</a> | <a 
        href='delete_post.php?
        id={$row['id']}'>Delete</a><hr>";
    }
} else {
    echo "No posts available.";
}
?>

</body>
</html>