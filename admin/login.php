<?php
session_start();
$err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "db");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_name'] = $user['name'];
            header("Location: dashboard.php");
            exit;
        } else {
            $err = "Invalid password.";
        }
    } else {
        $err = "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow" style="width: 400px;">
        <h3 class="text-center mb-3">Admin Login</h3>
        <?php if ($err): ?>
            <div class="alert alert-danger"><?= $err ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
</body>
</html>
