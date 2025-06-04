<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: views/auth/login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Beranda</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        Selamat datang, <strong><?= htmlspecialchars($user['username']) ?></strong> (<?= htmlspecialchars($user['role']) ?>)!
    </div>
    <a href="controllers/AuthController.php?action=logout" class="btn btn-danger">Logout</a>
</div>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>