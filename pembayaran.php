<?php
session_start();
include 'koneksi.php';

// Cek apakah pelanggan sudah login
if (!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$idpem = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Ambil data pembelian
$ambil = $koneksi->prepare("SELECT * FROM pembelian WHERE id_pembelian = ?");
$ambil->bind_param("i", $idpem);
$ambil->execute();
$result = $ambil->get_result();
$detpem = $result->fetch_assoc();

// Cek apakah data pembelian ditemukan
if (!$detpem) {
    echo "<script>alert('Data pembelian tidak ditemukan!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// Cek apakah pelanggan yang login sesuai dengan pemilik pembelian
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];
if ($id_pelanggan_login !== $detpem["id_pelanggan"]) {
    echo "<script>alert('Akses Dilarang!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pembayaran</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .panel {
            border-radius: 10px;
            border: 1px solid #2E8B57;
        }
        .panel-heading {
            background-color: #98FB98;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #2E8B57;
        }
        .btn-primary {
            background-color: #2E8B57;
            border: none;
            width: 100%;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #1d6b43;
        }
        .upload-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }
        .upload-preview {
            width: 100%;
            height: 180px;
            border-radius: 5px;
            border: 2px dashed #2E8B57;
            background-color: #E0F2F1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .custom-file-input {
            display: none;
        }
        .custom-file-label {
            display: block;
            background-color: #2E8B57;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }
        .custom-file-label:hover {
            background-color: #1d6b43;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>


<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>KONFIRMASI PEMBAYARAN</h3>
                </div>
                <div class="panel-body">
                    <p class="text-center"><strong>Total Tagihan: Rp. <?php echo number_format($detpem["total_pembelian"], 0, ',', '.'); ?></strong></p>

                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Pengirim</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Bank</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="bank" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah Transfer</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="jumlah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Upload Bukti</label>
                            <div class="col-md-9">
                                <div class="upload-preview-container">
                                    <div class="upload-preview" id="uploadPreview">
                                        <p>Pilih gambar</p>
                                    </div>
                                    <label for="fileUpload" class="custom-file-label">Pilih Gambar</label>
                                    <input type="file" class="custom-file-input" id="fileUpload" name="bukti" accept=".jpg,.jpeg,.png" required onchange="previewImage()">
                                    <small class="text-danger">Format: JPG/JPEG/PNG, Max 2MB</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" name="kirim">KIRIM</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function previewImage() {
                            const file = document.getElementById("fileUpload").files[0];
                            const previewContainer = document.getElementById("uploadPreview");

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["kirim"])) {
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis") . $namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    $koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

    $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");

    echo "<script>alert('Terima kasih sudah mengirim bukti pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

</body>
</html>
