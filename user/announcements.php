<?php
// ✅ Database connection (adjust if using db.php)
$conn = new mysqli("localhost", "root", "", "db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admission Announcements</title>
    <link href="/css/style.css" rel="stylesheet"> <!-- If using your custom style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Latest Admission Announcements</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                            <ul class="list-unstyled">
                                <li><strong>Course:</strong> <?= $row['course'] ?></li>
                                <li><strong>Deadline:</strong> <?= $row['deadline'] ?></li>
                                <li><strong>University:</strong> <?= $row['university'] ?></li>
                                <li><strong>State:</strong> <?= $row['state'] ?></li>
                            </ul>
                            <a href="<?= htmlspecialchars($row['apply_link']) ?>" class="btn btn-primary" target="_blank">Apply Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No announcements found.</p>
    <?php endif; ?>
</div>

</body>
</html>
