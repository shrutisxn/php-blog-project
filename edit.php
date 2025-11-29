<?php 
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container mt-5">

<h2 class="text-warning mb-4">✏ Edit Post</h2>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="6" required><?php echo $post['content']; ?></textarea>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>

</form>

<?php
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $conn->query("UPDATE posts SET title='$title', content='$content' WHERE id=$id");
    echo "<script>window.location='index.php'</script>";
}
?>

</div>
</body>
</html>