<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Edit User</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required />
        </div>
        <div class="mb-3">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select">
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
        <a href="UserController.php?action=list" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>