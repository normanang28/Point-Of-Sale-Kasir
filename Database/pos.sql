-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 02:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(4) NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `maker_barang` int(4) NOT NULL,
  `tanggal_barang` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `jumlah`, `harga_barang`, `maker_barang`, `tanggal_barang`) VALUES
(5, 'ltuf-01', 'laptop tuf gaming a15', '5', '17000000', 2, '2024-01-31 14:40:57'),
(6, 'lmsi-01', 'laptop mSI GF63 Thin 12UCX', '10', '9900000', 2, '2024-01-31 14:42:53'),
(7, 'ltuf-02', 'laptop tuf gaming f15', '2', '18000000', 2, '2024-01-31 14:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(4) NOT NULL,
  `id_barang_barang` int(4) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `maker_bm` int(4) NOT NULL,
  `tanggal_bm` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_bm` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_barang_barang`, `stok`, `nama_supplier`, `maker_bm`, `tanggal_bm`, `tgl_bm`) VALUES
(1, 5, '5', 'norman ang', 2, '2024-01-31 19:21:21', '2024-01-31'),
(4, 6, '10', 'kelsey malcius kley', 2, '2024-01-31 19:29:31', '2024-01-31'),
(5, 7, '2', 'asep sumanto', 2, '2024-01-31 19:30:04', '2024-01-31');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `HPUS_BM` AFTER DELETE ON `barang_masuk` FOR EACH ROW update barang set jumlah = jumlah-old.stok WHERE id_barang = old.id_barang_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TMBH_BM` AFTER INSERT ON `barang_masuk` FOR EACH ROW UPDATE barang SET jumlah = jumlah + new.stok WHERE id_barang = new.id_barang_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(4) NOT NULL,
  `id_user_petugas` int(4) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `status` int(4) NOT NULL,
  `maker_petugas` int(4) NOT NULL,
  `tanggal_petugas` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_user_petugas`, `nama_petugas`, `no_telp`, `status`, `maker_petugas`, `tanggal_petugas`) VALUES
(1, 2, 'super admin', '081371035253', 1, 2, '2024-01-30 20:31:50'),
(2, 4, 'admin admin', '0813710352533', 1, 2, '2024-01-30 21:48:53'),
(3, 5, 'kasir - 01', '08137103525333', 1, 2, '2024-01-30 21:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(4) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`) VALUES
(2, 'super admin', '3dcf34a6023633a0d92521ec9c8d5ae4', 1, ''),
(4, 'admin', '3dcf34a6023633a0d92521ec9c8d5ae4', 2, ''),
(5, 'kasir 01', '3dcf34a6023633a0d92521ec9c8d5ae4', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `KODE_BARANG` (`kode_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `NO_TELP` (`no_telp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `USERNAME` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
