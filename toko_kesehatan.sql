-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql106.byetcluster.com
-- Generation Time: Jun 16, 2025 at 04:44 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39242960_toko_kesehatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin2', 'admin2000', 'admin2'),
(2, 'admin', 'tescobaakun123123*', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Analgesik (Pereda nyeri)'),
(2, 'Antibiotik'),
(3, 'Antipiretik (Penurun demam)'),
(4, 'Antasida (Pengurang asam lambung)'),
(5, 'Vitamin & Suplemen'),
(6, 'Antihistamin (Anti-alergi)');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Surabaya', 10000),
(2, 'Sidoarjo', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'user1@gmail.com', 'user2000', 'user1', '082230013245', 'Jl. Medokan'),
(2, 'tes@gmail.com', '123123', 'test', '123123123', 'asdasd'),
(3, 'testing1@gmail.com', '123123', 'testing1', '083167565545', 'alamat 123');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 2, 'asd', 'asd', 4123123, '2025-06-11', '2025061114151803.jpg'),
(3, 4, 'test', 'asdsadsa', 17000, '2025-06-11', '20250611154915biogesic.jpg'),
(4, 6, 'testing1', 'mandiri', 44500, '2025-06-16', '20250616041436unnamed.png'),
(5, 10, 'asd', 'asd', 17000, '2025-06-16', '20250616042718unnamed.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(2, 2, 1, '2025-06-11', 355000, 'Surabaya', 10000, '123123', 'sudah kirim pembayaran', ''),
(3, 2, 1, '2025-06-11', 355000, 'Surabaya', 10000, '12312', 'pending', ''),
(4, 2, 1, '2025-06-11', 17000, 'Surabaya', 10000, 'aSDSA', 'batal', '123'),
(5, 2, 1, '2025-06-16', 24000, 'Surabaya', 10000, 'test', 'pending', ''),
(6, 3, 1, '2025-06-16', 44500, 'Surabaya', 10000, 'asd 123', 'sudah kirim pembayaran', ''),
(7, 3, 1, '2025-06-16', 20500, 'Surabaya', 10000, 'asd', 'pending', ''),
(8, 3, 1, '2025-06-16', 20500, 'Surabaya', 10000, 'saxc', 'pending', ''),
(9, 3, 2, '2025-06-16', 22500, 'Sidoarjo', 12000, 'sadas', 'pending', ''),
(10, 3, 1, '2025-06-16', 17000, 'Surabaya', 10000, 'asd', 'batal', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(4, 2, 2, 1),
(5, 3, 2, 1),
(6, 4, 3, 1),
(7, 5, 2, 1),
(8, 5, 6, 1),
(9, 6, 2, 1),
(10, 6, 30, 2),
(11, 7, 2, 1),
(12, 8, 2, 1),
(13, 9, 2, 1),
(14, 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`) VALUES
(1, 3, 'Paracetamol 500 mg', 5000, 500, 'paracetamol.jpg', 'Obat antipiretik dan analgesik untuk menurunkan demam dan meredakan nyeri ringan hingga sedang.'),
(2, 6, 'Amoxicillin 500 mg', 10500, 500, 'amoxilin.jpg', 'Antibiotik golongan penisilin untuk mengobati infeksi bakteri seperti ISPA, infeksi kulit, dan THT.'),
(3, 6, 'Cetirizine 10 mg', 7000, 10, 'centrizine.jpg', 'Antihistamin untuk meredakan gejala alergi seperti bersin, gatal, dan mata berair.'),
(6, 4, 'Promag', 3500, 300, 'promag.jpg', 'Antasida untuk meredakan gejala sakit maag dan nyeri ulu hati akibat kelebihan asam lambung.'),
(7, 5, 'neurobion', 21000, 450, 'neurobion.jpg', 'Vitamin B kompleks untuk menjaga kesehatan saraf dan mengatasi kekurangan vitamin B1, B6, dan B12.'),
(8, 1, 'Ibuprofen 200 mg', 6500, 200, '1669952265_ib.jpg', 'Obat pereda nyeri dan peradangan, juga digunakan untuk menurunkan demam.'),
(9, 4, 'Mylanta', 8000, 10, 'mylanta.jpg', ' Obat antasida cair untuk mengatasi gejala maag dan perut kembung.'),
(10, 1, 'Antalgin 500 mg', 5000, 500, 'antalgin.jpg', 'Obat pereda nyeri dan antiinflamasi ringan.'),
(29, 3, 'Biogesic', 4500, 500, 'biogesic.jpg', 'bahan aktif utama, yang berfungsi untuk meredakan demam dan nyeri ringan hingga sedang, seperti sakit kepala, nyeri otot, nyeri haid, dan sakit gigi'),
(30, 2, 'Cefadroxil', 12000, 500, 'Cefadroxil.jpg', 'Obat sakit kepala dan nyeri otot dengan kombinasi parasetamol dan kafein.'),
(31, 6, 'Loratadine 10 mg', 6000, 10, 'loratadin.jpg', 'digunakan untuk meredakan gejala alergi, seperti bersin, hidung tersumbat, mata berair, dan gatal-gatal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
