<?php
include('config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please login first.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "✅ Post added successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
</head>
<body>
<h2>Add New Post</h2>
<form method="POST" action="">
    Title: <input type="text" name="title" required><br><br>
    Content:<br>
    <textarea name="content" rows="5" cols="40" required></textarea><br><br>
    <button type="submit">Add Post</button>
</form>
</body>
</html>