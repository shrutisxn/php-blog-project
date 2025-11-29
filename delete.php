<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM posts WHERE id=$id");

echo "<script>window.location='index.php'</script>";
?>