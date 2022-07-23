<?php include '../../config/koneksi.php'; ?>
<?php date_default_timezone_set('Asia/Jakarta') ?>

<?php

$id_sales = $_POST['id_sales'];
$id_pelanggan = $_POST['id_pelanggan'];
$waktu = date("H:i:s");
$tanggal = date('Y-m-d', strtotime($_POST['tgl'])) . ' ' . $waktu;
$tanggalonly = date('Y-m-d', strtotime($_POST['tgl']));







// =============================================== untuk transaksi barang keluar ======================================

// simpan data di tb transaksi barang keluar

mysqli_query($conn, "INSERT INTO transaksi_barang_keluar VALUES('','$id_sales','$id_pelanggan','$tanggal')");

// mendapatkan id transaksi barang keluar

$id_transaksi_barang_keluar = $conn->insert_id;


// ============ ambil semua data di tmp_barang_gudang =====================================================================

$querytmp = mysqli_query($conn, "SELECT * FROM tmp_barang_gudang");
while ($lihattmp = mysqli_fetch_assoc($querytmp)) {

	$id_barang[] = $lihattmp['tmp_id_barang'];
	$jumlah[] = $lihattmp['tmp_jumlah'];
}

// ======================================================================================================================



// ================================================ untuk stok ====================================================


$banyak = mysqli_num_rows($querytmp);

for ($i = 0; $i < $banyak; $i++) {


	// lihat id_barang di stok

	$querys = mysqli_query($conn, "SELECT * FROM stok WHERE id_barang = '$id_barang[$i]'");

	$lihats = mysqli_fetch_assoc($querys);


	$sisa = $lihats['jumlah'] - $jumlah[$i];


	// update jumlah barang di stok

	mysqli_query($conn, "UPDATE stok SET jumlah = '$sisa' WHERE id_barang = '$id_barang[$i]'");





	// ================================================ untuk barang keluar =================================================

	// dan terakhir simpan setiap proses di barang keluar

	mysqli_query($conn, "INSERT INTO barang_keluar VALUES('','$id_transaksi_barang_keluar','$id_barang[$i]','$id_sales','$id_pelanggan','$tanggalonly','$jumlah[$i]','')");

	$id_barang_keluar[] = $conn->insert_id;








	// =================================================== untuk kartu stok =========================================

	// lihat id_barang di kartu stok, ambil data paling akhir

	$queryk = mysqli_query($conn, "SELECT * FROM kartu_stok WHERE id_barang = '$id_barang[$i]' ORDER BY id_kartu_stok DESC LIMIT 1");

	// kurangi jumlah barang

	$lihatk = mysqli_fetch_assoc($queryk);

	$id_kartu_stok_atas = $lihatk['id_kartu_stok'];


	$jml_baru = $lihatk['sisa'] - $jumlah[$i];

	// simpan di tb kartu stok

	mysqli_query($conn, "INSERT INTO kartu_stok VALUES('','$id_kartu_stok_atas','$tanggal','','$id_transaksi_barang_keluar','','$id_barang_keluar[$i]','$id_barang[$i]','-','$id_sales','$id_pelanggan','','$jumlah[$i]','$jml_baru','-')");

	// id_kartu_stok, id_kartu_stok_atas, tgl_kartu_stok, id_transaksi_barang_masuk, id_transaksi_barang_keluar, id_barang_masuk, id_barang_keluar, id_barang, id_supplier, id_sales, id_pelanggan, jumlah_masuk, jumlah_keluar, sisa, keterangan

}


// kemudian hapus semua data di tmp_barang_gudang
mysqli_query($conn, "DELETE FROM tmp_barang_gudang");
mysqli_query($conn, "ALTER TABLE tmp_barang_gudang AUTO_INCREMENT=1");


?>