<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pelanggan sudah login
if (!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Belanja</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
        }
        h3 {
            color: #2E8B57;
            text-align: center;
            font-weight: bold;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #2E8B57;
        }
        .table th {
            background-color: #98FB98;
            color: black;
            font-weight: bold;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-info {
            background-color: #2E8B57;
            border: none;
            color: white;
        }
        .btn-info:hover {
            background-color: #1d6b43;
        }
        .btn-success, .btn-warning {
            font-size: 14px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<section class="riwayat">
    <div class="container">
        <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"]; ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $nomor = 1;
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                // Ambil data pembelian pelanggan
                $query = $koneksi->prepare("SELECT * FROM pembelian WHERE id_pelanggan = ?");
                $query->bind_param("i", $id_pelanggan);
                $query->execute();
                $result = $query->get_result();

                while ($pecah = $result->fetch_assoc()) {
                    $id_pembelian = $pecah["id_pembelian"];

                    // Cek apakah ada pembayaran untuk ID pembelian ini
                    $query_pembayaran = $koneksi->prepare("SELECT * FROM pembayaran WHERE id_pembelian = ?");
                    $query_pembayaran->bind_param("i", $id_pembelian);
                    $query_pembayaran->execute();
                    $result_pembayaran = $query_pembayaran->get_result();
                    $data_pembayaran = $result_pembayaran->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah["tanggal_pembelian"]; ?></td>
                    <td>
                        <?php echo $pecah["status_pembelian"]; ?>
                        <?php if (!empty($pecah['resi_pengiriman'])): ?>
                        <br><small>Resi: <?php echo $pecah['resi_pengiriman']; ?></small>
                        <?php endif; ?>
                    </td>   
                    <td>Rp <?php echo number_format($pecah["total_pembelian"], 0, ',', '.'); ?></td>
                    <td>
                        <a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info btn-sm" target="_blank" >NOTA</a>
                        <?php if ($pecah['status_pembelian'] == "pending"): ?>
                            <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success btn-sm">
                                INPUT PEMBAYARAN
                            </a>  
                        <?php elseif ($data_pembayaran): ?>  <!-- Tampilkan hanya jika pembayaran ada -->
                            <a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning btn-sm">
                                LIHAT PEMBAYARAN
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
