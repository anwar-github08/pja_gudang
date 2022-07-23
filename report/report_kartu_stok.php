<?php
include '../config/koneksi.php';
include '../config/validasi.php';
include '../gudang/functions/function.php';
?>
<?php error_reporting(0); ?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Kartu Stok</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">
	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">



</head>

<body>

	<form method="post">


		<?php include '../a_navbar.php'; ?>

		<h5>Laporan Barang Masuk Dan Keluar</h5>
		<hr>
		<br>

		<!-- untuk mengambil data barang -->

		<?php $query = mysqli_query($conn, "SELECT * FROM stok JOIN barang ON stok.id_barang = barang.id_barang ORDER BY nama_barang ASC"); ?>

		<table class="table table-dark">

			<tr>
				<td>Dari Tanggal <br><br><input type="text" name="tgl_awal" id="tgl_awal" class="form-control mb-3" placeholder="Tanggal Awal" autocomplete="off" style="width: 400px"></td>

				<td>Sampai Tanggal <br><br><input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control mb-3" placeholder="Tanggal Akhir" autocomplete="off" style="width: 400px">

			</tr>
			<tr>
				<td>
					<label>Barang</label><br>
					<select name="id_barang" size="1" class="form-control mb-3" style="width: 400px" id="select2">
						<option value="&">-- semua --</option>
						<?php while ($lihat1 = mysqli_fetch_assoc($query)) :; ?>
							<option value="<?= $lihat1['id_barang'] ?>&<?= $lihat1['nama_barang'] ?>"><?= $lihat1['nama_barang'] ?></option>
						<?php endwhile ?>
					</select> <br><br>
					<button type="submit" class="btn btn-info btn-sm" name="cetak_barang">Tampilkan</button>
					<button type="submit" onclick="return confirm('Update..?')" class="btn btn-danger btn-sm" name="trigger">Trigger Kartu Stok</button>
				</td>
				<td></td>
			</tr>
		</table>

		<?php include '../a_footer.php'; ?>

		<script src="../aset/select2/dist/js/select2.min.js"></script>
		<script src="../aset/tgl/flatpickr.js"></script>

		<script>
			config = {
				dateFormat: "d-m-Y",
			}
			flatpickr("#tgl_awal", config);
			flatpickr("#tgl_akhir", config);
		</script>

		<!-- fungsi select2 -->
		<script>
			$(document).ready(function() {
				$('select[size=1]').select2();
			});
		</script>
	</form>
</body>

</html>

<?php

if (isset($_POST['trigger'])) {

	$ex = explode('&', $_POST['id_barang']);

	$id_barang = $ex[0];
	$nama_barang = $ex[1];

	triggerKartuStok($id_barang);

	echo "<script>alert('berhasil diupdate..!')</script>";
}
?>

<?php if (isset($_POST['cetak_barang'])) {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	$ex = explode('&', $_POST['id_barang']);

	$id_barang = $ex[0];
	$nama_barang = $ex[1];

	// $exb = explode('&', $_POST['bulan']);

	// $bulan = $exb[0];
	// $bulanindo = $exb[1];

	// $tgl_awal_bulan = date('Y-m-d', strtotime('first day of'.$bulan));
	// $tgl_akhir_bulan = date('Y-m-d', strtotime('last day of'.$bulan));


	if ($tgl_awal == '' and $tgl_akhir == '' and $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_kartu_stok.php?index=cetak_semua'</script>";
	} elseif ($tgl_awal == '' and $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_kartu_stok.php?index=cetak_barang&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_kartu_stok.php?index=cetak_tanggal&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir'</script>";
	} else {

		echo "<script>location='cetak_report_gudang/cetak_kartu_stok.php?index=cetak_tanggal_barang&id_barang=$id_barang&nama_barang=$nama_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir'</script>";
	}
} ?>