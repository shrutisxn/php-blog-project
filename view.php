<?php 
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container mt-5">

<div class="card shadow-sm p-4">
    <h2><?php echo $post['title']; ?></h2>
    <p class="text-muted"><?php echo $post['created_at']; ?></p>
    <p><?php echo nl2br($post['content']); ?></p>

    <a href="index.php" class="btn btn-secondary">Back</a>
</div>

</div>
</body>
</html>