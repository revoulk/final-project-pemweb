<?php 
session_start();
include 'koneksi.php';

// Jika pelanggan belum login, alihkan ke halaman login
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan login terlebih dahulu.');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Cek apakah keranjang kosong, jika ya, alihkan ke halaman keranjang
if (!isset($_SESSION["keranjang"]) || empty($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang belanja masih kosong, silakan belanja terlebih dahulu.');</script>";
    echo "<script>location='keranjang.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Toko Kesehatan</title>
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
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #2E8B57;
            border: none;
            padding: 10px 20px;
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
        <h2 class="text-center">🛍️ Checkout</h2>
        <hr>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>    
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION["keranjang"]) && !empty($_SESSION["keranjang"])): ?>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
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
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $subharga; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">⚠️ Keranjang belanja kosong.</td>
                    </tr>
                <?php endif; ?>
            </tbody>    
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                </tr>
            </tfoot>
        </table>

        <!-- Form Checkout -->
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']; ?>" class="form-control">
                    </div>
                </div>    
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pilih Ongkos Kirim</label>
                        <select class="form-control" name="id_ongkir" required>
                            <option value="">Pilih Ongkir</option>
                            <?php 
                            $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while ($perongkir = $ambil->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $perongkir["id_ongkir"]; ?>">
                                <?php echo $perongkir['nama_kota']; ?> - Rp. <?php echo number_format($perongkir['tarif']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>    
            </div>

            <div class="form-group">
                <label>Alamat Lengkap Pengiriman</label>
                <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat pengiriman (termasuk kode pos)" required></textarea>
            </div>

            <button class="btn btn-primary btn-block" name="checkout">✅ Proses Checkout</button>
        </form>

        <?php 
        if (isset($_POST["checkout"])) {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];

            // Ambil data ongkir
            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $nama_kota = $arrayongkir['nama_kota'];
            $tarif = $arrayongkir['tarif'];

            $total_pembelian = $totalbelanja + $tarif;
            
            // Simpan data pembelian
            $koneksi->query("INSERT INTO pembelian 
                (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) 
                VALUES 
                ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");

            $id_pembelian_barusan = $koneksi->insert_id;
            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                $koneksi->query("INSERT INTO pembelian_produk 
                    (id_pembelian, id_produk, jumlah) 
                    VALUES 
                    ('$id_pembelian_barusan', '$id_produk', '$jumlah')");
            }

            // Kosongkan keranjang
            unset($_SESSION["keranjang"]);

            echo "<script>alert('Checkout Berhasil!');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
        ?>
    </div>
</section>

</body>
</html>
