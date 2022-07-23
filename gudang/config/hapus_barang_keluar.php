<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
include '../functions/function.php';

$id_barang_keluar = $_GET['id_barang_keluar'];
$id_transaksi_barang_keluar = $_GET['id_tr_barang_keluar'];
$id_barang = $_GET['id_barang'];

// update kartu stok
mysqli_query($conn, "UPDATE kartu_stok SET jumlah_keluar = 0, keterangan = 'Dihapus' WHERE id_barang_keluar = $id_barang_keluar");

// trigger kartu stok
triggerKartuStok($id_barang);

// hapus barang keluar
mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_barang_keluar = $id_barang_keluar");

echo "<script>location='../detail_barang_keluar.php?id_transaksi_barang_keluar=$id_transaksi_barang_keluar'</script>";
