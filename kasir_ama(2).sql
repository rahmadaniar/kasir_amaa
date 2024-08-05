-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_ama`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_jenis_barang`, `id_supplier`, `nama`, `harga`, `stok`) VALUES
(8, 0, 0, 'Bubur ayam', 15000, 9),
(13, 0, 0, 'mie', 3000, 3449),
(15, 0, 0, 'pelembab', 100000, 50),
(17, 0, 0, 'laptop', 12000000, 3),
(20, 0, 0, 'udang', 45000, 1),
(24, 0, 0, 'celana', 30000, 2),
(25, 0, 0, 'baju', 20000, 2),
(28, 0, 0, 'cumi', 20000, 2),
(29, 0, 0, 'ikan bandeng', 30000, 99);

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `id_kantor_pusat` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `nama_jenis_barang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kantor_pusat`
--

CREATE TABLE `kantor_pusat` (
  `id_kantor_pusat` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `NPWP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` int(11) NOT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki','','') NOT NULL,
  `total_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` int(11) NOT NULL,
  `no_rekening` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `email`, `no_telp`, `no_rekening`) VALUES
(1, 'pt. superindo', 'jl sukajadi', 'perindo@gmail.com', 89765324, 1000986434),
(3, 'pt.indonesia', 'jl sumatera', 'indoraya@gmail.com', 984326789, 2147483647),
(4, 'aaaa', 'aaaa', 'aaa@gmail.com', 985432209, 10098747);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_transaksi_detail` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_diskon` int(11) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `nominal_tunai` int(11) NOT NULL,
  `invoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_member`, `id_cabang`, `id_transaksi_detail`, `kembalian`, `ppn`, `tanggal`, `total_diskon`, `total_transaksi`, `nominal_tunai`, `invoice`) VALUES
(7, 0, 0, 0, 0, 400000, 0, '2024-07-03', 4000, 40000, 400000, 0),
(8, 0, 0, 0, 0, 22, 0, '2024-07-04', 20009, 15000, 2000000, 0),
(9, 0, 0, 0, 0, 11000, 0, '2024-07-09', 0, 90000, 100000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('super_admin','admin','kasir','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis_barang` (`id_jenis_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD KEY `id_kantor_pusat` (`id_kantor_pusat`);

--
-- Indexes for table `kantor_pusat`
--
ALTER TABLE `kantor_pusat`
  ADD PRIMARY KEY (`id_kantor_pusat`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`,`id_member`,`id_cabang`,`id_transaksi_detail`),
  ADD KEY `id_user_2` (`id_user`,`id_member`,`id_cabang`,`id_transaksi_detail`),
  ADD KEY `id_user_3` (`id_user`,`id_member`,`id_cabang`,`id_transaksi_detail`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_tranaksi` (`id_transaksi`,`id_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kantor_pusat`
--
ALTER TABLE `kantor_pusat`
  MODIFY `id_kantor_pusat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
