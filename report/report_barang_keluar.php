<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Barang Keluar</title>

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

		<h5>Laporan Barang Keluar</h5>
		<hr>
		<br>

		<!-- ==================================================== untuk tampil data sales dan pelanggan ========================== -->

		<?php $query = mysqli_query($conn, "SELECT * FROM sales order by nama_sales asc"); ?>
		<?php $query1 = mysqli_query($conn, "SELECT * FROM pelanggan order by nama_pelanggan asc"); ?>
		<?php $query2 = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC"); ?>

		<!-- ===================================================== ============================= =================================== -->

		<table class="table table-dark">
			<tr>
				<td>Dari Tanggal <br><br><input type="text" name="tgl_awal" id="tgl_awal" class="form-control mb-3" placeholder="Tanggal Awal" autocomplete="off" style="width: 80%"></td>

				<td>Sampai Tanggal <br><br><input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control mb-3" placeholder="Tanggal Akhir" autocomplete="off" style="width: 80%">

			</tr>

			<tr>
				<td>

					<label>Sales</label><br>
					<select name="id_sales" size="1" class="form-control mb-3" style="width: 80%">
						<option value="&">-- semua --</option>
						<?php while ($lihat = mysqli_fetch_assoc($query)) :; ?>
							<option value="<?= $lihat['id_sales'] ?>&<?= $lihat['nama_sales'] ?>"><?= $lihat['nama_sales'] ?></option>
						<?php endwhile ?>
					</select>
				</td>
				<td>

					<label>Pelanggan</label><br>
					<select name="id_pelanggan" size="1" class="form-control mb-3" style="width: 80%">
						<option value="&">-- semua --</option>
						<?php while ($lihat1 = mysqli_fetch_assoc($query1)) :; ?>
							<option value="<?= $lihat1['id_pelanggan'] ?>&<?= $lihat1['nama_pelanggan'] ?>"><?= $lihat1['nama_pelanggan'] ?></option>
						<?php endwhile ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label>Barang</label><br>
					<select name="id_barang" size="1" class="form-control mb-3" style="width: 80%">
						<option value="&">-- semua --</option>
						<?php while ($lihat2 = mysqli_fetch_assoc($query2)) :; ?>
							<option value="<?= $lihat2['id_barang'] ?>&<?= $lihat2['nama_barang'] ?>"><?= $lihat2['nama_barang'] ?></option>
						<?php endwhile ?>
					</select><br><br>
					<button type="submit" name="cetak" class="btn btn-info btn-sm">Tampilkan</button>
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




<?php if (isset($_POST['cetak'])) {

	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	$ex = explode('&', $_POST['id_sales']);

	$id_sales = $ex[0];
	$nama_sales = $ex[1];

	$exp = explode('&', $_POST['id_pelanggan']);

	$id_pelanggan = $exp[0];
	$nama_pelanggan = $exp[1];

	$exb = explode('&', $_POST['id_barang']);

	$id_barang = $exb[0];
	$nama_barang = $exb[1];


	if ($id_sales == '' && $id_pelanggan == '' && $id_barang == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_semua'</script>";
	} elseif ($id_sales == '' && $id_barang == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_pelanggan&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan'</script>";
	} elseif ($id_pelanggan == '' && $id_barang == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_sales&id_sales=$id_sales&nama_sales=$nama_sales'</script>";
	} elseif ($id_pelanggan == '' && $id_sales == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_barang&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_pelanggan == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_sales_barang&id_sales=$id_sales&nama_sales=$nama_sales&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_sales == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_pelanggan_barang&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_barang == '' && $tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_sales_pelanggan&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_sales=$id_sales&nama_sales=$nama_sales'</script>";
	} elseif ($id_sales == '' && $id_pelanggan == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir'</script>";
	} elseif ($tgl_awal == '' && $tgl_akhir == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_sales_pelanggan_barang&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_sales=$id_sales&nama_sales=$nama_sales&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_sales == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_pelanggan&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan'</script>";
	} elseif ($id_pelanggan == '' && $id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_sales&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_sales=$id_sales&nama_sales=$nama_sales'</script>";
	} elseif ($id_pelanggan == '' && $id_sales == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_sales == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_pelanggan_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_pelanggan == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_sales_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_sales=$id_sales&nama_sales=$nama_sales&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	} elseif ($id_barang == '') {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_sales_pelanggan&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_sales=$id_sales&nama_sales=$nama_sales'</script>";
	} else {

		echo "<script>location='cetak_report_gudang/cetak_barang_keluar.php?index=cetak_tanggal_sales_pelanggan_barang&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir&id_pelanggan=$id_pelanggan&nama_pelanggan=$nama_pelanggan&id_sales=$id_sales&nama_sales=$nama_sales&id_barang=$id_barang&nama_barang=$nama_barang'</script>";
	}
} ?>