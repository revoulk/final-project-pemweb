<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Register</h2>
    <form action="../../controllers/AuthController.php?action=register" method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-success">Register</button>
        <a href="login.php" class="btn btn-link">Sudah punya akun? Login</a>
    </form>
</div>
<script src=\"../../assets/js/bootstrap.bundle.min.js\"></script>
</body>
</html>
