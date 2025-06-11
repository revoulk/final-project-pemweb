<?php
$ambil=$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah=$ambil->fetch_assoc();
$pelanggan=$pecah['id_kategori'];

$koneksi->query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

echo "<script>alert('Data Kategori Terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";
?>