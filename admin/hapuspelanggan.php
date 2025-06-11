<?php
$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
$pelanggan=$pecah['id_pelanggan'];

$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");

echo "<script>alert('Data Pelanggan Terhapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";
?>