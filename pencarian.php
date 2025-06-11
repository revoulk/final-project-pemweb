<?php 
session_start();
include 'koneksi.php';
$keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]) : '';

$semuadata = [];
if (!empty($keyword)) {
    $ambil = $koneksi->prepare("SELECT * FROM produk WHERE nama_produk LIKE ? OR deskripsi_produk LIKE ?");
    $likeKeyword = "%$keyword%";
    $ambil->bind_param("ss", $likeKeyword, $likeKeyword);
    $ambil->execute();
    $result = $ambil->get_result();

    while ($pecah = $result->fetch_assoc()) {
        $semuadata[] = $pecah;  
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PENCARIAN PRODUK</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 30px;
        }
        .thumbnail {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: white;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .caption h3 {
            font-size: 18px;
            font-weight: bold;
            color: #2E8B57;
        }
        .caption h5 {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            background-color: #2E8B57;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1d6b43;
        }
        .alert-danger {
            text-align: center;
            font-weight: bold;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h2 class="text-center" style="color: #2E8B57; font-weight: bold;">Hasil Pencarian: "<?php echo htmlspecialchars($keyword); ?>"</h2>

    <?php if (empty($semuadata)): ?>
        <div class="alert alert-danger">❌ Produk <strong><?php echo htmlspecialchars($keyword); ?></strong> tidak ditemukan!</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($semuadata as $value): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="thumbnail">
                        <img class="img-responsive" width="300" src="foto_produk/<?php echo htmlspecialchars($value["foto_produk"]); ?>" alt="Produk">
                        <div class="caption text-center">
                            <h3><?php echo htmlspecialchars($value["nama_produk"]); ?></h3>
                            <h5>Rp. <?php echo number_format($value["harga_produk"], 0, ',', '.'); ?></h5>
                            <a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary btn-sm">BELI</a>
                            <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-default btn-sm">DETAIL</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>

<!-- Js Plugins -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
<br><br><br>
<?php include 'footer.php'; ?>
</html>
