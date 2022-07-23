<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
include '../functions/function.php';

$id_transaksi_barang_masuk = $_GET['id_transaksi_barang_masuk'];

$query = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
while ($lihat = mysqli_fetch_Assoc($query)) {

	$id_barang_masuk = $lihat['id_barang_masuk'];
	$id_barang = $lihat['id_barang'];

	mysqli_query($conn, "UPDATE kartu_stok SET jumlah_masuk = 0, keterangan = 'Dihapus' WHERE id_barang_masuk = $id_barang_masuk");


	// trigger kartu stok
	triggerKartuStok($id_barang);
};

mysqli_query($conn, "DELETE FROM transaksi_barang_masuk WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
mysqli_query($conn, "DELETE FROM barang_masuk WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");

echo "<script>location='../tampil_barang_masuk.php'</script>";
