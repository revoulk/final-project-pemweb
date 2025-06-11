<?php 
session_start();
include 'koneksi.php';

// Jika keranjang kosong, redirect ke halaman utama
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, silakan belanja terlebih dahulu.');</script>";
    echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja | Toko Kesehatan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #2E8B57;
            color: white;
            text-align: center;
        }
        td {
            vertical-align: middle !important;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-primary {
            background-color: #2E8B57;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1d6b43;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<!-- Konten -->
<section class="konten">
    <div class="container">
        <h2 class="text-center">🛒 Keranjang Belanja</h2>
        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>    
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                <!-- Mengambil data produk dari database -->
                <?php 
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk= '$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah["harga_produk"] * $jumlah;
                ?>

                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah["nama_produk"]; ?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp. <?php echo number_format($subharga); ?></td>
                    <td>
                        <a href="hapuskeranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-xs">
                            ❌ Hapus
                        </a>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach ?>    
            </tbody>    
        </table>

        <div class="text-center">
            <a href="index.php" class="btn btn-secondary">🔄 Lanjutkan Belanja</a>
            <a href="checkout.php" class="btn btn-primary">✅ Checkout</a>
        </div>
    </div>
</section>

</body>
</html>
