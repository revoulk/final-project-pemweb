<?php 
session_start();
require_once 'koneksi.php';

require_once 'dompdf_2-0-3/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Pastikan user sudah login
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda harus login!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

// Ambil data pembelian terbaru oleh pelanggan
$query = mysqli_query($koneksi, "SELECT * FROM pembelian 
    JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
    WHERE pembelian.id_pelanggan = '$id_pelanggan'
    ORDER BY pembelian.id_pembelian DESC LIMIT 1");

$detail = mysqli_fetch_assoc($query);

// Ambil produk yang dibeli
$produk_query = mysqli_query($koneksi, "SELECT * FROM pembelian_produk 
    JOIN produk ON pembelian_produk.id_produk = produk.id_produk 
    WHERE pembelian_produk.id_pembelian = '{$detail['id_pembelian']}'");

// Inisialisasi Dompdf
$dompdf = new Dompdf();

$html = '
<style>
    body { font-family: Arial, sans-serif; color: #333; }
    .container { width: 100%; padding: 20px; }
    .header { text-align: center; color: #2E8B57; position: relative; }
    .header h2 { margin-bottom: 5px; }
    .logo { position: absolute; top: 10px; right: 10px; width: 50px; }
    .line { border-bottom: 2px solid #2E8B57; margin-bottom: 15px; }
    .section { margin-bottom: 20px; }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    .table th { background-color: #98FB98; color: black; font-weight: bold; }
    .total { font-weight: bold; }
    .footer { margin-top: 30px; text-align: center; font-style: italic; color: #2E8B57; }
</style>

<div class="container">
    <div class="header">
        <h2>Nota Pembelian</h2>
        <p><strong>Toko Obat Surabaya</strong></p>
        <div class="line"></div>
    </div>

    <div class="section">
        <h3 style="color:#2E8B57;">Informasi Pelanggan</h3>
        <p><strong>Nama:</strong> ' . htmlspecialchars($detail['nama_pelanggan']) . '</p>
        <p><strong>Telepon:</strong> ' . htmlspecialchars($detail['telepon_pelanggan']) . '</p>
        <p><strong>Alamat Pengiriman:</strong> ' . htmlspecialchars($detail['alamat_pengiriman']) . '</p>
    </div>

    <div class="section">
        <h3 style="color:#2E8B57;">Detail Pembelian</h3>
        <p><strong>No. Pembelian:</strong> ' . htmlspecialchars($detail['id_pembelian']) . '</p>
        <p><strong>Tanggal:</strong> ' . htmlspecialchars($detail['tanggal_pembelian']) . '</p>
        <p><strong>Kota:</strong> ' . htmlspecialchars($detail['nama_kota']) . ' (Ongkir: Rp. ' . number_format($detail['tarif'], 0, ',', '.') . ')</p>
    </div>

    <h3 style="color:#2E8B57;">Produk yang Dibeli</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>';

$grand_total = 0;
while ($produk = mysqli_fetch_assoc($produk_query)) {
    $subtotal = $produk['harga_produk'] * $produk['jumlah'];
    $grand_total += $subtotal;
    $html .= '
        <tr>
            <td>' . htmlspecialchars($produk['id_produk']) . '</td>
            <td>' . htmlspecialchars($produk['nama_produk']) . '</td>
            <td>Rp. ' . number_format($produk['harga_produk'], 0, ',', '.') . '</td>
            <td>' . htmlspecialchars($produk['jumlah']) . '</td>
            <td>Rp. ' . number_format($subtotal, 0, ',', '.') . '</td>
        </tr>';
}

$total_semua = $grand_total + $detail['tarif'];

$html .= '
        </tbody>
    </table>

    <div class="section">
        <h3 style="color:#2E8B57;">Total Pembayaran</h3>
        <p class="total"><strong>Subtotal:</strong> Rp. ' . number_format($grand_total, 0, ',', '.') . '</p>
        <p class="total"><strong>Ongkir:</strong> Rp. ' . number_format($detail['tarif'], 0, ',', '.') . '</p>
        <p class="total"><strong>Total Bayar:</strong> Rp. ' . number_format($total_semua, 0, ',', '.') . '</p>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di <strong>Toko Obat Surabaya</strong></p>
    </div>
</div>';

// Render PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Bersihkan output buffer agar tidak error
ob_end_clean();

// Output file PDF ke browser
$dompdf->stream('nota_pembelian.pdf', ['Attachment' => false]);

?>
