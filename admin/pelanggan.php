<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$koneksi = new mysqli("localhost", "root", "", "toko_kesehatan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
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
        .btn-danger {
            background-color: #DC143C;
            border: none;
        }
        .btn-danger:hover {
            background-color: #B22222;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Pelanggan</h2>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo $pecah['email_pelanggan']; ?></td>
                <td><?php echo $pecah['telepon_pelanggan']; ?></td>
                <td>
                    <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger btn-sm">HAPUS</a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
