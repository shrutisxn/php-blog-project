<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container mt-5">

<h2 class="text-success mb-4">➕ Create New Post</h2>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="6" required></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Save Post</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    $conn->query($sql);

    echo "<script>window.location='index.php'</script>";
}
?>

</div>
</body>
</html>