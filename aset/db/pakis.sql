-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 11:11 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `id_golongan_produk` varchar(20) DEFAULT NULL,
  `id_supplier` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(20) NOT NULL,
  `id_transaksi_barang_keluar` int(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `id_sales` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` int(10) NOT NULL,
  `keterangan_keluar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `kartu_stok_update_keluar` AFTER UPDATE ON `barang_keluar` FOR EACH ROW UPDATE kartu_stok SET kartu_stok.jumlah_keluar = new.jumlah_keluar WHERE kartu_stok.id_barang_keluar = new.id_barang_keluar
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_tambah` AFTER DELETE ON `barang_keluar` FOR EACH ROW UPDATE stok SET stok.jumlah = stok.jumlah + old.jumlah_keluar WHERE stok.id_barang = old.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(20) NOT NULL,
  `id_transaksi_barang_masuk` int(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keterangan_masuk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `kartu_stok_update` AFTER UPDATE ON `barang_masuk` FOR EACH ROW UPDATE kartu_stok SET kartu_stok.jumlah_masuk = new.jumlah WHERE kartu_stok.id_barang_masuk = new.id_barang_masuk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_delete` AFTER DELETE ON `barang_masuk` FOR EACH ROW UPDATE stok SET stok.jumlah = stok.jumlah - old.jumlah WHERE stok.id_barang = old.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `golongan_produk`
--

CREATE TABLE `golongan_produk` (
  `id_golongan_produk` varchar(20) NOT NULL,
  `nama_golongan_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok`
--

CREATE TABLE `kartu_stok` (
  `id_kartu_stok` int(10) NOT NULL,
  `id_kartu_stok_atas` int(20) NOT NULL,
  `tgl_kartu_stok` datetime NOT NULL,
  `id_transaksi_barang_masuk` int(20) NOT NULL,
  `id_transaksi_barang_keluar` int(20) NOT NULL,
  `id_barang_masuk` int(20) NOT NULL,
  `id_barang_keluar` int(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `id_sales` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `jumlah_masuk` int(10) NOT NULL,
  `jumlah_keluar` int(10) NOT NULL,
  `sisa` int(10) NOT NULL DEFAULT '0',
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `id_sales` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(200) NOT NULL,
  `telp_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` varchar(20) NOT NULL,
  `nama_sales` varchar(30) NOT NULL,
  `alamat_sales` varchar(100) NOT NULL,
  `telp_sales` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(20) NOT NULL,
  `id_barang` varchar(20) DEFAULT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` varchar(200) NOT NULL,
  `telp_supplier` varchar(15) NOT NULL,
  `email_supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_barang_gudang`
--

CREATE TABLE `tmp_barang_gudang` (
  `id_tmp_barang_gudang` int(11) NOT NULL,
  `tmp_id_barang` varchar(20) NOT NULL,
  `tmp_jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang_keluar`
--

CREATE TABLE `transaksi_barang_keluar` (
  `id_transaksi_barang_keluar` int(20) NOT NULL,
  `id_sales` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang_masuk`
--

CREATE TABLE `transaksi_barang_masuk` (
  `id_transaksi_barang_masuk` int(20) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_golongan_produk` (`id_golongan_produk`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_transaksi_barang_keluar` (`id_transaksi_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_transaksi_barang_masuk` (`id_transaksi_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `golongan_produk`
--
ALTER TABLE `golongan_produk`
  ADD PRIMARY KEY (`id_golongan_produk`);

--
-- Indexes for table `kartu_stok`
--
ALTER TABLE `kartu_stok`
  ADD PRIMARY KEY (`id_kartu_stok`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_barang_masuk` (`id_barang_masuk`),
  ADD KEY `id_barang_keluar` (`id_barang_keluar`),
  ADD KEY `id_kartu_stok_atas` (`id_kartu_stok_atas`),
  ADD KEY `id_transaksi_barang_masuk` (`id_transaksi_barang_masuk`),
  ADD KEY `id_transaksi_barang_keluar` (`id_transaksi_barang_keluar`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tmp_barang_gudang`
--
ALTER TABLE `tmp_barang_gudang`
  ADD PRIMARY KEY (`id_tmp_barang_gudang`);

--
-- Indexes for table `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  ADD PRIMARY KEY (`id_transaksi_barang_keluar`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  ADD PRIMARY KEY (`id_transaksi_barang_masuk`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_stok`
--
ALTER TABLE `kartu_stok`
  MODIFY `id_kartu_stok` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmp_barang_gudang`
--
ALTER TABLE `tmp_barang_gudang`
  MODIFY `id_tmp_barang_gudang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  MODIFY `id_transaksi_barang_keluar` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  MODIFY `id_transaksi_barang_masuk` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
