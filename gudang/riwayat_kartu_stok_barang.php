<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>


<!DOCTYPE html>
<html>

<head>
	<title>Kartu Stok</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>
<style>
	@media print {

		#cetak {
			display: none;
		}

	}
</style>
<form method="post">

	<body>

		<?php
		$id_barang = $_GET['id_barang'];
		$nama_barang = $_GET['nama_barang'];

		?>

		<div class="container">
			<br><br>
			<img src="../gambar/pakis22.png" class="img-fluid" width="60%"><br><br><br>
			<hr>

			<h4 align="center">Kartu Stok</h4>
			<hr>

			<button type="submit" name="cetak" class="btn btn-info btn-sm" id="cetak">Cetak</button>
			<button type="submit" name="excel" class="btn btn-success btn-sm" id="cetak">Excel</button>
			<a href="javascript:window.history.go(-1);" class="btn btn-danger btn-sm" id="cetak">Kembali</a><br><br>

			<?php if (isset($_POST['excel'])) {

				header("Content-type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename=kartu stok.xls");
			} ?>

			<table cellpadding="5" class="mb-2">
				<tr>
					<td>Kode Barang</td>
					<td>:</td>
					<td><?= $id_barang ?></td>
				</tr>
				<td>Nama Barang</td>
				<td>:</td>
				<td><?= $nama_barang ?></td>
				</tr>
			</table>

			<!-- tabel 2 -->
			<table border="1" cellpadding="10" width="100%">
				<thead align="center">
					<tr>
						<th>Tanggal</th>
						<th>Supplier</th>
						<th>Sales</th>
						<th>Pelanggan</th>
						<th>Jumlah Masuk</th>
						<th>Jumlah Keluar</th>
						<th>Sisa</th>
						<th>Ket</th>

					</tr>
				</thead>
				<tbody>
					<?php

					$query = mysqli_query($conn, "SELECT * FROM kartu_stok INNER JOIN barang ON kartu_stok.id_barang = barang.id_barang INNER JOIN supplier ON kartu_stok.id_supplier = supplier.id_supplier INNER JOIN sales ON kartu_stok.id_sales = sales.id_sales INNER JOIN pelanggan ON kartu_stok.id_pelanggan = pelanggan.id_pelanggan WHERE kartu_stok.id_barang = '$id_barang'");


					while ($lihat = mysqli_fetch_assoc($query)) :;


					?>
						<tr>
							<td><?= date('d M Y / H:i', strtotime($lihat['tgl_kartu_stok'])) ?></td>
							<td><?= $lihat['nama_supplier'] ?></td>
							<td><?= $lihat['nama_sales'] ?></td>
							<td><?= $lihat['nama_pelanggan'] ?></td>
							<?php if ($lihat['jumlah_masuk'] == 0) : ?>
								<td style="color: lightgrey;" align="center"><?= $lihat['jumlah_masuk'] ?></td>
							<?php else : ?>
								<td style="color: blue" align="center"><?= $lihat['jumlah_masuk'] ?></td>
							<?php endif ?>
							<?php if ($lihat['jumlah_keluar'] == 0) : ?>
								<td style="color: lightgrey" align="center"><?= $lihat['jumlah_keluar'] ?></td>
							<?php else : ?>
								<td style="color: red" align="center"><?= $lihat['jumlah_keluar'] ?></td>
							<?php endif ?>
							<td style="font-weight: bold;color: green" align="center"><?= $lihat['sisa'] ?></td>
							<td><?= $lihat['keterangan'] ?></td>
						</tr>
					<?php endwhile ?>
				</tbody>
			</table>
		</div>

	</body>
</form>

</html>


<?php if (isset($_POST['cetak'])) {

	echo "<script>window.print()</script>";
} ?>