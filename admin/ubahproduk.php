<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
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
    <h2>Ubah Produk</h2>
    <hr>

    <?php
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $pecah = $ambil->fetch_assoc();
    $datakategori = array();
    $ambil_kategori = $koneksi->query("SELECT * FROM kategori");
    while($tiap = $ambil_kategori->fetch_assoc()) {
        $datakategori[] = $tiap;
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="id_kategori" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($datakategori as $value): ?>
                    <option value="<?php echo $value["id_kategori"] ?>" <?php if($pecah["id_kategori"] == $value["id_kategori"]) echo "selected"; ?>>
                        <?php echo $value["nama_kategori"] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label>Berat (mg)</label>
            <input type="number" step="0.01" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label>Foto Produk Saat Ini (500 x 500)</label> <br>
            <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
        </div>
        <div class="form-group">
            <label>Ganti Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="10" required><?php echo $pecah['deskripsi_produk']; ?></textarea>
        </div>
        <button class="btn btn-success" name="ubah">UBAH</button>
    </form>

    <?php
    if (isset($_POST['ubah']))
    {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];

        if (!empty($lokasifoto)) {
            move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
            $koneksi->query("UPDATE produk SET 
                nama_produk='$_POST[nama]',
                harga_produk='$_POST[harga]',
                berat_produk='$_POST[berat]',
                foto_produk='$namafoto',
                deskripsi_produk='$_POST[deskripsi]',
                id_kategori='$_POST[id_kategori]'
                WHERE id_produk='$_GET[id]'");
        } else {
            $koneksi->query("UPDATE produk SET 
                nama_produk='$_POST[nama]',
                harga_produk='$_POST[harga]',
                berat_produk='$_POST[berat]',
                deskripsi_produk='$_POST[deskripsi]',
                id_kategori='$_POST[id_kategori]'
                WHERE id_produk='$_GET[id]'");
        }

        echo "<script>alert('Data Produk Telah Diubah');</script>";
        echo "<script>location='index.php?halaman=produk';</script>";
    }
    ?>

</div>

</body>
</html>
