<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pembelian</title>
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
        .btn-info {
            background-color: #4682B4;
            border: none;
        }
        .btn-info:hover {
            background-color: #4169E1;
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
    <h2>Data Pembelian</h2>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pembelian</th>
                <th>Status Pembelian</th>
                <th>Total (Rp)</th>
                <th>Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($pecah['tanggal_pembelian'])); ?></td>
                <td><?php echo ucfirst($pecah['status_pembelian']); ?></td>
                <td>Rp <?php echo number_format($pecah['total_pembelian'], 0, ',', '.'); ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info btn-sm">DETAIL</a>
                    <?php if ($pecah['status_pembelian'] !== "pending"): ?>
                        <a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success btn-sm">PEMBAYARAN</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
