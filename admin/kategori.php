<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
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
        .btn-primary {
            background-color: #2E8B57;
            border: none;
        }
        .btn-primary:hover {
            background-color: #228B22;
        }
        .table-bordered {
            border: 2px solid #2E8B57;
        }
        .table thead {
            background-color: #98FB98;
            color: black;
            font-weight: bold;
        }
        .table-bordered td, .table-bordered th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Kategori</h2>
    <hr>

    <p><a href="index.php?halaman=tambahkategori" class="btn btn-primary">TAMBAH DATA</a></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>KATEGORI</th>
                <th>PILIHAN</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nama_kategori']; ?></td>
                    <td>
                        <a href="index.php?halaman=ubahkategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-warning btn-sm">UBAH</a>
                        <a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-danger btn-sm">HAPUS</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
