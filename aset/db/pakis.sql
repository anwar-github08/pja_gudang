-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Jun 2022 pada 04.16
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.3.6

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
-- Struktur dari tabel `admin`
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
-- Struktur dari tabel `barang`
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
-- Struktur dari tabel `barang_keluar`
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
-- Trigger `barang_keluar`
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
-- Struktur dari tabel `barang_masuk`
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
-- Trigger `barang_masuk`
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
-- Struktur dari tabel `golongan_produk`
--

CREATE TABLE `golongan_produk` (
  `id_golongan_produk` varchar(20) NOT NULL,
  `nama_golongan_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_stok`
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
  `sisa` int(10) NOT NULL DEFAULT 0,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
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
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id_sales` varchar(20) NOT NULL,
  `nama_sales` varchar(30) NOT NULL,
  `alamat_sales` varchar(100) NOT NULL,
  `telp_sales` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(20) NOT NULL,
  `id_barang` varchar(20) DEFAULT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
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
-- Struktur dari tabel `tmp_barang_gudang`
--

CREATE TABLE `tmp_barang_gudang` (
  `id_tmp_barang_gudang` int(11) NOT NULL,
  `tmp_id_barang` varchar(20) NOT NULL,
  `tmp_jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_barang_keluar`
--

CREATE TABLE `transaksi_barang_keluar` (
  `id_transaksi_barang_keluar` int(20) NOT NULL,
  `id_sales` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_barang_masuk`
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
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_golongan_produk` (`id_golongan_produk`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_transaksi_barang_keluar` (`id_transaksi_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_transaksi_barang_masuk` (`id_transaksi_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `golongan_produk`
--
ALTER TABLE `golongan_produk`
  ADD PRIMARY KEY (`id_golongan_produk`);

--
-- Indeks untuk tabel `kartu_stok`
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
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tmp_barang_gudang`
--
ALTER TABLE `tmp_barang_gudang`
  ADD PRIMARY KEY (`id_tmp_barang_gudang`);

--
-- Indeks untuk tabel `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  ADD PRIMARY KEY (`id_transaksi_barang_keluar`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  ADD PRIMARY KEY (`id_transaksi_barang_masuk`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kartu_stok`
--
ALTER TABLE `kartu_stok`
  MODIFY `id_kartu_stok` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tmp_barang_gudang`
--
ALTER TABLE `tmp_barang_gudang`
  MODIFY `id_tmp_barang_gudang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  MODIFY `id_transaksi_barang_keluar` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  MODIFY `id_transaksi_barang_masuk` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
