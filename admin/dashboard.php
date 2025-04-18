<?php
    session_start();
    if (!isset($_SESSION['admin_email'])) {
        header("Location: login.php");
        exit;
    }
    // echo "<h2>Welcome, Admin!</h2>";
    // echo "<a href='add_announcement.php'>Add Admission Announcement</a><br>";
    // echo "<a href='logout.php'>Logout</a>";
?>

<!-- admin/dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">College Admin Panel</a>
        <a href="add_announcement.php" class="btn btn-light">Add Announcement</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container">
    <h2>Welcome, Admin</h2>
    <p>Manage your admission announcements here.</p>
</div>
</body>
</html>
