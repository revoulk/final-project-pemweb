<?php $base = '/uas_pemweb/final-project-pemweb/'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
    <link href="<?= $base ?>assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Daftar User</h2>
    <a href="<?= $base ?>controllers/UserController.php?action=create" class="btn btn-success mb-3">Tambah User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td>
                    <a href="<?= $base ?>controllers/UserController.php?action=edit&id=<?= $user['id'] ?>">Edit</a>
                    <a href="<?= $base ?>controllers/UserController.php?action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="<?= $base ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
