<?php


include '../../config/koneksi.php';
include '../functions/function.php';

$id_barang = $_POST['id_barang'];
$id_barang_masuk = $_POST['id_barang_masuk'];
$id_transaksi_barang_masuk = $_POST['id_transaksi_barang_masuk'];

$jumlah = $_POST['jumlah'];
$jumlah_lama = $_POST['jumlah_lama'];



// ================================= lihat barang di stok terlebih dahulu ===================================

$query1 = mysqli_query($conn, "SELECT * FROM stok  WHERE id_barang = '$id_barang'");

// jumlah distok dikurangi jumlah lama 
// kemudian ditambah jumlah baaru
$lihat1 = mysqli_fetch_assoc($query1);
$jumlah_stok = $lihat1['jumlah'];


$jml_default = $jumlah_stok - $jumlah_lama;

$jml_baru = $jml_default + $jumlah;

// update stok
mysqli_query($conn, "UPDATE stok SET jumlah = '$jml_baru' WHERE id_barang = '$id_barang' ");

// update barang masuk
mysqli_query($conn, "UPDATE barang_masuk SET jumlah = '$jumlah' WHERE id_barang_masuk = $id_barang_masuk ");

// update kartu stok
mysqli_query($conn, "UPDATE kartu_stok SET jumlah_masuk = '$jumlah' WHERE id_barang_masuk = $id_barang_masuk ");

// trigger kartu stok
triggerKartuStok($id_barang);

echo "<script>location='../detail_barang_masuk.php?id_transaksi_barang_masuk=$id_transaksi_barang_masuk'</script>";
