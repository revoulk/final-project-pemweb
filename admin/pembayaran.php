<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';

// mendapatkan id pembelian dari URL
$id_pembelian = $_GET['id'];

// mengambil data pembayaran
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian= '$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .container {
            margin-top: 30px;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-weight: bold;
            color: #2E8B57;
        }
        hr {
            border-top: 2px solid #2E8B57;
        }
        table {
            width: 100%;
        }
        .table th {
            width: 40%;
            background-color: #2E8B57;
            color: white;
        }
        .form-group label {
            font-weight: bold;
            color: #2E8B57;
        }
        .form-control {
            border: 1px solid #2E8B57;
        }
        .btn-success {
            background-color: #2E8B57;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-success:hover {
            background-color: #228B22;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detail Pembayaran</h2>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?php echo $detail['nama'] ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?php echo $detail['bank'] ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp <?php echo number_format($detail['jumlah']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo $detail['tanggal'] ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 text-center">
            <h5>Bukti Pembayaran</h5>
            <img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" class="img-responsive">
        </div>
    </div>

    <hr>
    <h3 class="text-center">Proses Pengiriman</h3>

    <form method="post">
        <div class="form-group">
            <label>No Resi Pengiriman</label>
            <input type="text" class="form-control" name="resi" placeholder="Masukkan No Resi" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
                <option value="">Pilih Status</option>
                <option value="lunas">Lunas</option>
                <option value="barang dikirim">Barang Dikirim</option>
                <option value="batal">Batal</option>
            </select>
        </div>
        <button class="btn btn-success" name="proses">PROSES</button>
    </form>

    <?php
    if (isset($_POST["proses"])) {
        $resi = trim($_POST["resi"]);
        $status = $_POST["status"];

        if (!empty($resi) && !empty($status)) {
            $koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status'
                WHERE id_pembelian='$id_pembelian'");

            echo "<div class='alert alert-success text-center'>✅ Data Pembayaran Berhasil Diperbarui!</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
        } else {
            echo "<div class='alert alert-danger text-center'>❌ No Resi dan Status tidak boleh kosong!</div>";
        }
    }
    ?>
</div>

</body>
</html>
