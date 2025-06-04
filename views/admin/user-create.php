<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Tambah User</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="UserController.php?action=list" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>