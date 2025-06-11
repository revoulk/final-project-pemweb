<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$koneksi = new mysqli("localhost", "root", "", "toko_kesehatan");

$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";

if (isset($_POST["kirim"])) {
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $ambil = $koneksi->query("SELECT * FROM pembelian pm 
                              LEFT JOIN pelanggan pl ON pm.id_pelanggan = pl.id_pelanggan 
                              WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembelian</title>
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
        .btn-primary {
            background-color: #2E8B57;
            border: none;
        }
        .btn-primary:hover {
            background-color: #228B22;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Laporan Pembelian Dari <?php echo $tgl_mulai ?> Hingga <?php echo $tgl_selesai ?></h2>
    <hr>

    <form method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>TANGGAL MULAI</label>
                    <input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>TANGGAL SELESAI</label>
                    <input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
                </div>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label><br>
                <button class="btn btn-primary" name="kirim">LIHAT</button>
            </div>
        </div>    
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>PELANGGAN</th>
                <th>TANGGAL</th>
                <th>JUMLAH (Rp)</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php $total=0; ?>
            <?php foreach ($semuadata as $key => $value): ?>
            <?php $total+=$value['total_pembelian']; ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value["nama_pelanggan"]; ?></td>
                <td><?php echo date("d-m-Y", strtotime($value["tanggal_pembelian"])); ?></td>
                <td>Rp <?php echo number_format($value["total_pembelian"], 0, ',', '.'); ?></td>
                <td><?php echo $value["status_pembelian"]; ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">TOTAL</th>
                <th>Rp <?php echo number_format($total, 0, ',', '.'); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
