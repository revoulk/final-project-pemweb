<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pembelian</title>
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
        .panel {
            border-radius: 10px;
            border: 1px solid #2E8B57;
        }
        .panel-heading {
            background-color: #98FB98;
            color: black;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 0 0;
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
    <h2>Detail Pembelian</h2>
    <hr>

    <?php
    $ambil = $koneksi->query("SELECT * FROM pembelian 
        JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
        WHERE pembelian.id_pembelian = '$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    ?>

    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">PEMBELIAN</div>
                <div class="panel-body">
                    <p>
                        Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
                        Total: Rp <?php echo number_format($detail['total_pembelian']); ?><br>
                        Status: <?php echo $detail['status_pembelian']; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">PELANGGAN</div>
                <div class="panel-body">
                    <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
                    <p>
                        Telepon: <?php echo $detail['telepon_pelanggan']; ?> <br>
                        Email: <?php echo $detail['email_pelanggan']; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">PENGIRIMAN</div>
                <div class="panel-body">
                    <strong><?php echo $detail["nama_kota"]; ?></strong><br>
                    <p>
                        Tarif: Rp <?php echo number_format($detail["tarif"]); ?><br>
                        Alamat: <?php echo $detail["alamat_pengiriman"]; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h4>Detail Pembelian :</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian_produk 
                JOIN produk ON pembelian_produk.id_produk = produk.id_produk 
                WHERE pembelian_produk.id_pembelian = '$_GET[id]'");
            while ($pecah = $ambil->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $pecah['id_produk']; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td>Rp <?php echo number_format($pecah['harga_produk']); ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td>Rp <?php echo number_format($pecah['harga_produk'] * $pecah['jumlah']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
