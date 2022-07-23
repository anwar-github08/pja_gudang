<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
include '../functions/function.php';

$id_transaksi_barang_keluar = $_GET['id_transaksi_barang_keluar'];

$query = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
while ($lihat = mysqli_fetch_Assoc($query)) {

	$id_barang_keluar = $lihat['id_barang_keluar'];
	$id_barang = $lihat['id_barang'];

	mysqli_query($conn, "UPDATE kartu_stok SET jumlah_keluar = 0, keterangan = 'Dihapus' WHERE id_barang_keluar = $id_barang_keluar");

	// trigger kartu stok
	triggerKartuStok($id_barang);
};

mysqli_query($conn, "DELETE FROM transaksi_barang_keluar WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");

echo "<script>location='../tampil_barang_keluar.php'</script>";
