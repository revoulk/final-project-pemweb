-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2022 pada 08.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_farmasy_app_primhus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `nama`, `role`) VALUES
('Ab71528', 'admin@admin.com', '$2y$10$Gg/miVi/MaVMG0qWOLvBJOosxCDXaZe2S7iHTlYZ2W.Vvl6Z6aiK2', 'Admin', 'admin'),
('Af82380', 'rsuprimahusada@gmail.com', '$2y$10$D917D0ceZnfA64JElT08VO6lN/bjVjBaS6TbSyIyiRImqWAoFfmjq', 'RSU Prima Husada', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_obat`
--

CREATE TABLE `data_obat` (
  `id` bigint(20) NOT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `botol` int(11) DEFAULT NULL,
  `strip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_obat`
--

INSERT INTO `data_obat` (`id`, `kode_obat`, `nama_obat`, `harga`, `botol`, `strip`) VALUES
(1, 'B000111', 'Paracetamol', 10000, 0, 70),
(2, 'B000222', 'Vitamin C', 1000, 0, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) NOT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_terverifikasi`
--

CREATE TABLE `penjualan_terverifikasi` (
  `id` bigint(20) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `tanggal_verifikasi` date DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `no_pasien` varchar(100) DEFAULT NULL,
  `no_RR` varchar(100) DEFAULT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_terverifikasi`
--

INSERT INTO `penjualan_terverifikasi` (`id`, `tanggal_pembelian`, `tanggal_verifikasi`, `kode_obat`, `nama_obat`, `no_pasien`, `no_RR`, `nama_pasien`, `jumlah`, `satuan`) VALUES
(4, '2022-04-03', '2022-04-03', 'B000111', 'Paracetamol', '111', '111', 'Supri', 10, 'Strip'),
(5, '2022-04-03', '2022-04-03', 'B000222', 'Vitamin C', '111', '111', 'Supri', 10, 'Strip'),
(6, '2022-04-03', '2022-04-03', 'B000333', 'OBH', '111', '111', 'Supri', 10, 'Botol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sisa_obat`
--

CREATE TABLE `sisa_obat` (
  `id` bigint(20) NOT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `botol` int(11) DEFAULT NULL,
  `strip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sisa_obat`
--

INSERT INTO `sisa_obat` (`id`, `kode_obat`, `nama_obat`, `botol`, `strip`) VALUES
(7, 'B000333', 'OBH', 110, 0),
(8, 'B000111', 'Paracetamol', 0, 70),
(9, 'B000222', 'Vitamin C', 0, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` bigint(20) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `distributor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `tanggal_masuk`, `kode_obat`, `nama_obat`, `harga`, `jumlah`, `satuan`, `distributor`) VALUES
(5, '2022-04-03', 'B000333', 'OBH', 11000, 100, 'Botol', 'Usagi'),
(6, '2022-04-03', 'B000333', 'OBH', 11000, 20, 'Botol', 'Usagi'),
(7, '2022-04-03', 'B000111', 'Paracetamol', 10000, 80, 'Strip', 'Usagi'),
(8, '2022-04-03', 'B000222', 'Vitamin C', 1000, 20, 'Strip', 'Usagi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(1000) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama_lengkap`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `role`, `is_active`) VALUES
('Ue94930', 'hyugahinata@gmail.com', '$2y$10$uluEFW6Ud.xwc.SmANzGQeNmvXgF8DzU.6Bk3UFSUHJ2kVaTZnjbi', 'Hinata Hyuga', 'Perempuan', 'Random', 'Konoha', '2001-12-27', 'Konoha', '085810203040', 'user', 1),
('Ug75139', 'raflyujicoba@gmail.com', '$2y$10$d/nhCF4vShWJSksvqPRDf.vq2bZG4Rc2KDKWULIziQ4XsvAtsOo3K', 'Muhammad Rafly', 'Laki-laki', 'Islam', 'Surabaya', '2001-01-30', 'Kebraon 1/142 RT 001 RW 002 Karang Pilang Surabaya', '085840302010', 'user', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pembelian`
--

CREATE TABLE `user_pembelian` (
  `id` bigint(20) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `no_pasien` varchar(100) DEFAULT NULL,
  `no_RR` varchar(100) DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_pembelian`
--

INSERT INTO `user_pembelian` (`id`, `id_user`, `no_pasien`, `no_RR`, `kode_obat`, `nama_obat`, `harga`, `jumlah`, `satuan`) VALUES
(1, 'Ue94930', '111', '111', 'B000222', 'Vitamin C', 1000, 5, 'Strip'),
(2, 'Ug75139', '222', '222', 'B000111', 'Paracetamol', 10000, 10, 'Strip');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_riwayat`
--

CREATE TABLE `user_riwayat` (
  `id` bigint(20) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_penjualan`
--

CREATE TABLE `verifikasi_penjualan` (
  `id` bigint(20) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `no_pasien` varchar(100) DEFAULT NULL,
  `no_RR` varchar(100) DEFAULT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `verifikasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `verifikasi_penjualan`
--

INSERT INTO `verifikasi_penjualan` (`id`, `tanggal_pembelian`, `kode_obat`, `nama_obat`, `no_pasien`, `no_RR`, `nama_pasien`, `jumlah`, `satuan`, `verifikasi`) VALUES
(1, '2022-04-03', 'B000111', 'Paracetamol', '111', '111', 'Supri', 10, 'Strip', 'ya'),
(2, '2022-04-03', 'B000222', 'Vitamin C', '111', '111', 'Supri', 10, 'Strip', 'ya'),
(3, '2022-04-03', 'B000333', 'OBH', '111', '111', 'Supri', 10, 'Botol', 'ya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_terverifikasi`
--
ALTER TABLE `penjualan_terverifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sisa_obat`
--
ALTER TABLE `sisa_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_pembelian`
--
ALTER TABLE `user_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user_riwayat`
--
ALTER TABLE `user_riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `verifikasi_penjualan`
--
ALTER TABLE `verifikasi_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan_terverifikasi`
--
ALTER TABLE `penjualan_terverifikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sisa_obat`
--
ALTER TABLE `sisa_obat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_pembelian`
--
ALTER TABLE `user_pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_riwayat`
--
ALTER TABLE `user_riwayat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_penjualan`
--
ALTER TABLE `verifikasi_penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `user_pembelian`
--
ALTER TABLE `user_pembelian`
  ADD CONSTRAINT `user_pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;
