<?php include '../../config/koneksi.php'; ?>
<?php date_default_timezone_set('Asia/Jakarta') ?>

<?php

$id_supplier = $_POST['id_supplier'];
$waktu = date("H:i:s");
// tipe datanya datetime
$tanggal = date('Y-m-d', strtotime($_POST['tgl'])) . ' ' . $waktu;
// tipde data date
$tanggalonly = date('Y-m-d', strtotime($_POST['tgl']));


// =============================================== untuk transaksi barang masuk ======================================

// simpan data di tb transaksi barang masuk

mysqli_query($conn, "INSERT INTO transaksi_barang_masuk VALUES('','$id_supplier','$tanggal')");

// mendapatkan id transaksi barang masuk

$id_transaksi_barang_masuk = $conn->insert_id;



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

	// jika id barang sudah ada di stok maka tambah jumlah barang

	if (mysqli_num_rows($querys) == 1) {

		$sisa = $lihats['jumlah'] + $jumlah[$i];

		mysqli_query($conn, "UPDATE stok SET jumlah = '$sisa' WHERE id_barang = '$id_barang[$i]'");
	} else {

		// jika belum ada simpan di stok

		mysqli_query($conn, "INSERT INTO stok VALUES ('','$id_barang[$i]','$jumlah[$i]')");
	}




	// ================================================ untuk barang masuk =================================================

	// dan terakhir simpan setiap proses di barang masuk

	mysqli_query($conn, "INSERT INTO barang_masuk VALUES('','$id_transaksi_barang_masuk','$id_barang[$i]','$id_supplier','$tanggalonly','$jumlah[$i]','')");

	// dapat id barang_masuk baru
	$id_barang_masuk[] = $conn->insert_id;




	// =================================================== untuk kartu stok =========================================

	// lihat id_barang di kartu stok, ambil data paling akhir berdasr id_barang

	$queryk = mysqli_query($conn, "SELECT * FROM kartu_stok WHERE id_barang = '$id_barang[$i]' ORDER BY id_kartu_stok DESC LIMIT 1");

	// jika id_barang sudah ada, maka tambah jumlah barang

	if (mysqli_num_rows($queryk) != 0) {

		$lihatk = mysqli_fetch_assoc($queryk);

		$id_kartu_stok_atas = $lihatk['id_kartu_stok'];

		$jml_baru = $lihatk['sisa'] + $jumlah[$i];

		// simpan di tb kartu stok

		mysqli_query($conn, "INSERT INTO kartu_stok VALUES('','$id_kartu_stok_atas','$tanggal','$id_transaksi_barang_masuk','','$id_barang_masuk[$i]','','$id_barang[$i]','$id_supplier','-','-','$jumlah[$i]','','$jml_baru','-')");
	} else {
		// jika barang belum ada,,simpan biasa 

		mysqli_query($conn, "INSERT INTO kartu_stok VALUES('','','$tanggal','$id_transaksi_barang_masuk','','$id_barang_masuk[$i]','','$id_barang[$i]','$id_supplier','-','-','$jumlah[$i]','','$jumlah[$i]','-')");
	}

	// ============================================== end kartu stok ======================================================


}

// kemudian hapus semua data di tmp_barang_gudang dan set id
mysqli_query($conn, "DELETE FROM tmp_barang_gudang");
mysqli_query($conn, "ALTER TABLE tmp_barang_gudang AUTO_INCREMENT=1");

?>