<?php 
include 'db.php';

// Pagination settings
$limit = 3; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Query with Search + Pagination
$sql = "SELECT * FROM posts 
        WHERE title LIKE '%$search%' OR content LIKE '%$search%' 
        ORDER BY created_at DESC 
        LIMIT $start, $limit";

$result = $conn->query($sql);

// Count total posts for pagination
$countQuery = "SELECT COUNT(*) AS total FROM posts 
               WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
$countResult = $conn->query($countQuery);
$total = $countResult->fetch_assoc()['total'];

$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4 text-primary">📘 Blog Posts</h1>

    <!-- Search Bar -->
    <form method="GET" class="input-group mb-4">
        <input type="text" name="search" class="form-control" placeholder="Search posts..." value="<?php echo $search; ?>">
        <button class="btn btn-primary">Search</button>
    </form>

    <a href="create.php" class="btn btn-success mb-4">➕ Create New Post</a>

    <!-- Posts List -->
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h3><?php echo $row['title']; ?></h3>
                <p class="text-muted small"><?php echo $row['created_at']; ?></p>
                <p><?php echo substr($row['content'], 0, 150) . "..."; ?></p>

                <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View</a>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&search=<?php echo $search; ?>">« Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&search=<?php echo $search; ?>">Next »</a></li>
            <?php endif; ?>
        </ul>
    </nav>

</div>
</body>
</html>