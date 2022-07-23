<?php
include '../../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id_transaksi_barang_masuk = $_POST['id_transaksi_barang_masuk'];

$waktu = $_POST['waktu'];
$tanggal = date('Y-m-d', strtotime($_POST['tgl'])) . ' ' . $waktu;
$tanggalonly = date('Y-m-d', strtotime($_POST['tgl']));
$id_supplier = $_POST['id_supplier'];

mysqli_query($conn, "UPDATE transaksi_barang_masuk SET id_supplier = '$id_supplier', tanggal = '$tanggal' WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk ");

mysqli_query($conn, "UPDATE barang_masuk SET id_supplier = '$id_supplier', tanggal = '$tanggalonly' WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk ");

mysqli_query($conn, "UPDATE kartu_stok SET tgl_kartu_stok = '$tanggal', id_supplier = '$id_supplier' WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");

echo "<script>location='../tampil_barang_masuk.php'</script>";
