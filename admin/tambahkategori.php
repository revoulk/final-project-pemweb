<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-weight: bold;
            color: #2E8B57;
        }
        hr {
            border-top: 2px solid #2E8B57;
        }
        .form-group label {
            font-weight: bold;
            color: #2E8B57;
        }
        .form-control {
            border: 1px solid #2E8B57;
        }
        .btn-success {
            background-color: #2E8B57;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-success:hover {
            background-color: #228B22;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Kategori Baru</h2>
    <hr>

    <form method="post">
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="kategori" placeholder="Masukkan nama kategori" required>
        </div>
        <button class="btn btn-success" name="save">SIMPAN KATEGORI</button>
    </form>

    <?php
    if (isset($_POST['save'])) {
        $kategori = trim($_POST['kategori']);

        if (!empty($kategori)) {
            $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$kategori')");
            echo "<div class='alert alert-success text-center'>✅ Kategori Berhasil Ditambahkan!</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
        } else {
            echo "<div class='alert alert-danger text-center'>❌ Nama kategori tidak boleh kosong!</div>";
        }
    }
    ?>
</div>

</body>
</html>
