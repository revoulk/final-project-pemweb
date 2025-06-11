<?php 
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Toko Obat Surabaya</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 30px;
        }
        /* Styling untuk carousel */
        .carousel-inner img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
        }
        .carousel-caption h3 {
            background: rgba(46, 139, 87, 0.8);
            padding: 10px;
            border-radius: 5px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            display: inline-block;
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
    </style>
</head>
<body>    

<?php include 'menu.php'; ?>

<!-- Carousel -->
<div class="container">
    <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>        
            </ol>

            <!-- Carousel content -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="01.jpg" alt="Gambar 1">
                    <div class="carousel-caption">
                        <h3>Toko Obat Surabaya - Terpercaya & Berkualitas</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="02.jpg" alt="Gambar 2">
                    <div class="carousel-caption">
                        <h3>Obat Terlengkap</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="03.jpg" alt="Gambar 3">
                    <div class="carousel-caption">
                        <h3>Pelayanan Cepat & Aman</h3>
                    </div>
                </div>                
            </div>

            <!-- Next & Previous Buttons -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<br><br>

<!-- Produk -->
<div class="container">
    <h2 class="text-center" style="color: #2E8B57; font-weight: bold;">Produk Obat</h2>
    <div class="row">
        <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
        <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
        <div class="col-md-3">
            <div class="thumbnail">
                <img class="img-responsive" width="300" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="Produk">
                <div class="caption">    
                    <h3><?php echo $perproduk['nama_produk']; ?></h3>
                    <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                    <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary btn-sm">BELI</a>
                    <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default btn-sm">DETAIL</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Js Plugins -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
<br><br><br>
<?php include 'footer.php'; ?>
</html>
