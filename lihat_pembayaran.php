2<?php 
session_start();
include 'koneksi.php';

// Pastikan ada parameter ID pembelian
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "<script>alert('ID Pembelian tidak valid!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

$id_pembelian = $_GET["id"];

// Cek apakah pembayaran ada untuk pembelian ini
$ambil = $koneksi->prepare("SELECT * FROM pembayaran 
    LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian  
    WHERE pembelian.id_pembelian = ?");
$ambil->bind_param("i", $id_pembelian);
$ambil->execute();
$result = $ambil->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

$detbay = $result->fetch_assoc();

// Pastikan pelanggan yang melihat adalah pemilik transaksi
if ($_SESSION["pelanggan"]["id_pelanggan"] !== $detbay["id_pelanggan"]) {
    echo "<script>alert('DILARANG! Anda tidak berhak melihat pembayaran ini.');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
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
        .btn-primary {
            background-color: #2E8B57;
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background-color: #1d6b43;
        }
        .bukti-container {
            text-align: center;
            margin-top: 20px;
        }
        .bukti-container img {
            max-width: 100%;
            border-radius: 10px;
            border: 2px solid #2E8B57;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h3>Detail Pembayaran</h3>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Nama Pengirim</th>
                    <td><?php echo htmlspecialchars($detbay["nama"]); ?></td>
                </tr>
                <tr>
                    <th>Bank Tujuan</th>
                    <td><?php echo htmlspecialchars($detbay["bank"]); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Transfer</th>
                    <td><?php echo htmlspecialchars($detbay["tanggal"]); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Transfer</th>
                    <td>Rp. <?php echo number_format($detbay["jumlah"], 0, ',', '.'); ?></td>
                </tr>
            </table>
            <a href="riwayat.php" class="btn btn-primary">Kembali ke Riwayat</a>
        </div>
        <div class="col-md-6 bukti-container">
            <?php if (!empty($detbay["bukti"])): ?>
                <img src="bukti_pembayaran/<?php echo htmlspecialchars($detbay["bukti"]); ?>" alt="Bukti Pembayaran">
            <?php else: ?>
                <p class="text-danger">Bukti pembayaran tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
