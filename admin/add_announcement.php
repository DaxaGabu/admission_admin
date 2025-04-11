<!-- admin/add_announcement.php -->
<?php
$conn = new mysqli("localhost", "root", "", "db");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $course = $_POST['course'];
    $deadline = $_POST['deadline'];
    $link = $_POST['apply_link'];
    $state = $_POST['state'];
    $university = $_POST['university'];

    $sql = "INSERT INTO announcements (title, description, course, deadline, apply_link, state, university)
            VALUES ('$title', '$description', '$course', '$deadline', '$link', '$state', '$university')";
    $conn->query($sql);
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Announcement</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
        <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
        <input type="text" name="course" placeholder="Course (e.g., BSc, MBA)" class="form-control mb-2" required>
        <input type="date" name="deadline" class="form-control mb-2" required>
        <input type="url" name="apply_link" placeholder="Apply Link" class="form-control mb-2" required>
        <input type="text" name="state" placeholder="State" class="form-control mb-2" required>
        <input type="text" name="university" placeholder="University Name" class="form-control mb-2" required>
        <button class="btn btn-success">Add Announcement</button>
    </form>
</div>
</body>
</html>
