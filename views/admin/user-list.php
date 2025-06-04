<!DOCTYPE html>
<html>
<head>
    <title>List User</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>List User</h2>
    <a href="../../controllers/UserController.php?action=create" class="btn btn-primary mb-3">Tambah User</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Username</th><th>Role</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php foreach($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= $u['role'] ?></td>
                    <td>
                        <a href="UserController.php?action=edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="UserController.php?action=delete&id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>