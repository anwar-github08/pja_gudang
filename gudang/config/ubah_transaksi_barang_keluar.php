<?php
include '../../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id_transaksi_barang_keluar = $_POST['id_transaksi_barang_keluar'];

$waktu = $_POST['waktu'];
$tanggal = date('Y-m-d', strtotime($_POST['tgl'])) . ' ' . $waktu;
$tanggalonly = date('Y-m-d', strtotime($_POST['tgl']));
$id_sales = $_POST['id_sales'];
$id_pelanggan = $_POST['id_pelanggan'];

mysqli_query($conn, "UPDATE transaksi_barang_keluar SET id_sales = '$id_sales', id_pelanggan = '$id_pelanggan', tanggal_keluar = '$tanggal' WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar ");

mysqli_query($conn, "UPDATE barang_keluar SET id_sales = '$id_sales', id_pelanggan = '$id_pelanggan', tanggal_keluar = '$tanggalonly' WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar ");

mysqli_query($conn, "UPDATE kartu_stok SET tgl_kartu_stok = '$tanggal', id_sales = '$id_sales', id_pelanggan = '$id_pelanggan' WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");

echo "<script>location='../tampil_barang_keluar.php'</script>";
