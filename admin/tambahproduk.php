<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$koneksi = new mysqli("localhost", "root", "", "toko_kesehatan");

$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
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
    <h2>Tambah Produk Baru</h2>
    <hr>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Kategori Produk</label>
            <select class="form-control" name="id_kategori" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($datakategori as $value): ?>
                    <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama produk" required>
        </div>

        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" class="form-control" name="harga" placeholder="Masukkan harga produk" required>
        </div>

        <div class="form-group">
            <label>Berat (Kg)</label>
            <input type="number" class="form-control" name="berat" placeholder="Masukkan berat produk" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Produk</label>
            <textarea class="form-control" name="deskripsi" rows="5" placeholder="Masukkan deskripsi produk" required></textarea>
        </div>

        <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" class="form-control" name="foto" required>
        </div>

        <button class="btn btn-success" name="save">SIMPAN PRODUK</button>
    </form>

    <?php 
    if (isset($_POST['save'])) {
        $nama_foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];

        if (!empty($lokasi_foto)) {
            move_uploaded_file($lokasi_foto, "../foto_produk/".$nama_foto);

            $koneksi->query("INSERT INTO produk 
                (nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, id_kategori) 
                VALUES ('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$nama_foto', '$_POST[deskripsi]', '$_POST[id_kategori]')");

            echo "<div class='alert alert-success text-center'>✅ Produk Berhasil Ditambahkan!</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
        } else {
            echo "<div class='alert alert-danger text-center'>❌ Gagal menambahkan produk! Pastikan semua data telah diisi.</div>";
        }
    }
    ?>

</div>

</body>
</html>
