<?php 
session_start();
require_once 'koneksi.php';

// Mendapatkan id produk dari URL
$id_produk = $_GET["id"];

// Query ambil data produk
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk | Toko Kesehatan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 50px;
        }
        .produk-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .produk-card img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .produk-title {
            font-size: 24px;
            font-weight: bold;
            color: #2E8B57;
        }
        .produk-price {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }
        .produk-description {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
        .form-group {
            margin-top: 15px;
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

<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="Produk" class="img-responsive">
            </div>
            <div class="col-md-6">
                <div class="produk-card">
                    <h2 class="produk-title"><?php echo $detail["nama_produk"]; ?></h2>
                    <h4 class="produk-price">Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                    
                    <form method="post">
                        <div class="form-group">
                            <label>Jumlah:</label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">BELI</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <?php 
                    // Jika tombol beli ditekan
                    if (isset($_POST["beli"])) {
                        $jumlah = $_POST["jumlah"];
                        $_SESSION["keranjang"][$id_produk] = $jumlah;

                        echo "<script>alert('Produk telah masuk ke keranjang belanja!');</script>";
                        echo "<script>location='keranjang.php';</script>";
                    }
                    ?>

                    <p class="produk-description"><?php echo $detail["deskripsi_produk"]; ?></p>
                </div>
            </div>
        </div>    
    </div>
</section>

</body>
</html>
