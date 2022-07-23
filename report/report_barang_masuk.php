<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Barang Masuk</title>

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

		<h5>Laporan Barang Masuk</h5>
		<hr>
		<br>

		<?php
		$query1 = mysqli_query($conn, "SELECT * FROM supplier order by nama_supplier ASC");
		$query2 = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");
		?>

		<table class="table table-dark">
			<tr>
				<td>Dari Tanggal <br><br><input type="text" name="tgl_awal" id="tgl_awal" class="form-control mb-3" placeholder="Tanggal Awal" autocomplete="off" style="width: 80%"></td>

				<td>Sampai Tanggal <br><br><input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control mb-3" placeholder="Tanggal Akhir" autocomplete="off" style="width: 80%">

			</tr>

			<tr>
				<td>
					<label>Supplier</label><br>
					<select name="id_supplier" size="1" class="form-control" style="width: 80%">
						<option value="&">-- semua --</option>
						<?php while ($lihat1 = mysqli_fetch_assoc($query1)) :; ?>
							<option value="<?= $lihat1['id_supplier'] ?>&<?= $lihat1['nama_supplier'] ?>"><?= $lihat1['nama_supplier'] ?></option>
						<?php endwhile ?>
					</select> <br><br>
					<button type="submit" class="btn btn-info btn-sm" name="cetak">Tampilkan</button>
				</td>
				<td>
					<label>Barang</label><br>
					<select name="id_barang" size="1" class="form-control mb-3" style="width: 80%">
						<option value="&">-- semua --</option>
						<?php while ($lihat2 = mysqli_fetch_assoc($query2)) :; ?>
							<option value="<?= $lihat2['id_barang'] ?>&<?= $lihat2['nama_barang'] ?>"><?= $lihat2['nama_barang'] ?></option>
						<?php endwhile ?>
					</select>
				</td>
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



<?php if (isset($_POST['cetak'])) {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	$ex = explode('&', $_POST['id_supplier']);

	$id_supplier = $ex[0];
	$nama_supplier = $ex[1];

	$exb = explode('&', $_POST['id_barang']);

	$id_barang = $exb[0];
	$nama_barang = $exb[1];


	if ($id_supplier == '' && $tgl_awal == '' && $tgl_akhir == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_semua'</script>";
	} elseif ($tgl_awal == '' && $tgl_akhir == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_supplier&id_supplier=$id_supplier&nama_supplier=$nama_supplier'</script>";
	} elseif ($tgl_awal == '' && $tgl_akhir == '' && $id_supplier == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_barang&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_barang_supplier&id_barang=$id_barang&nama_barang=$nama_barang&id_supplier=$id_supplier&nama_supplier=$nama_supplier'</script>";
	} elseif ($id_supplier == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_tanggal&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir'</script>";
	} elseif ($id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_tanggal_supplier&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_supplier=$id_supplier&nama_supplier=$nama_supplier'</script>";
	} elseif ($id_supplier == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_tanggal_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} else {

		echo "<script>location='cetak_report_gudang/cetak_barang_masuk.php?index=cetak_tanggal_supplier_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_barang=$id_barang&nama_barang=$nama_barang&id_supplier=$id_supplier&nama_supplier=$nama_supplier'</script>";
	}
} ?>