<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
include '../functions/function.php';

$id_barang_masuk = $_GET['id_barang_masuk'];
$id_transaksi_barang_masuk = $_GET['id_tr_barang_masuk'];
$id_barang = $_GET['id_barang'];

// update kartu stok
mysqli_query($conn, "UPDATE kartu_stok SET jumlah_masuk = 0, keterangan = 'Dihapus' WHERE id_barang_masuk = $id_barang_masuk");

// trigger kartu stok
triggerKartuStok($id_barang);

// hapus barang masuk
mysqli_query($conn, "DELETE FROM barang_masuk WHERE id_barang_masuk = $id_barang_masuk");

echo "<script>location='../detail_barang_masuk.php?id_transaksi_barang_masuk=$id_transaksi_barang_masuk'</script>";
