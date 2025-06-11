<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$koneksi = new mysqli("localhost", "root", "", "toko_kesehatan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Kategori</title>
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
        }
        .btn-success:hover {
            background-color: #228B22;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ubah Kategori</h2>
    <hr>

    <?php
    $ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $pecah = $ambil->fetch_assoc();
    ?>

    <form method="post">
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="kategori" class="form-control" value="<?php echo htmlspecialchars($pecah['nama_kategori']); ?>" required>
        </div>
        <button class="btn btn-success" name="ubah">UBAH</button>
    </form>

    <?php
    if (isset($_POST['ubah'])) {
        $kategori_baru = trim($_POST['kategori']);
        if (!empty($kategori_baru)) {
            $koneksi->query("UPDATE kategori SET nama_kategori='$kategori_baru' WHERE id_kategori='$_GET[id]'");
            echo "<script>alert('Data Kategori Telah Diubah');</script>";
            echo "<script>location='index.php?halaman=kategori';</script>";
        } else {
            echo "<script>alert('Nama kategori tidak boleh kosong!');</script>";
        }
    }
    ?>

</div>

</body>
</html>
