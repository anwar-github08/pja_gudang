<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Kartu Stok</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../../aset/bootstrap-4.5.3/css/bootstrap.min.css">

	<link rel="icon" type="image/png" href="../../gambar/pakis11.png">
</head>
<style>
	@media print {

		#cetak {
			display: none;
		}
	}
</style>

<body>
	<form method="post">
		<div class="container">

			<br><br><img src="../../gambar/pakis22.png" class="img-fluid" width="60%"><br><br><br>
			<hr>
			<div class="text-center">
				<h4 align="center">Kartu Stok</h5>
			</div>
			<hr>

			<?php $index = $_GET['index']; ?>


			<button type="submit" name="cetak" class="btn btn-info btn-sm" id="cetak">Cetak</button>
			<button type="submit" name="excel" class="btn btn-success btn-sm" id="cetak">Excel</button>
			<a href="javascript:window.history.go(-1);" class="btn btn-danger btn-sm" id="cetak">Kembali</a><br><br>

			<?php if (isset($_POST['excel'])) {

				header("Content-type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename=kartu stok.xls");
			} ?>



			<!--================================================= untuk cetak semua data ============================================-->

			<?php if ($index == "cetak_semua") : ?>

				<!-- untuk ambil data barang di tabel stok tabel 1-->
				<?php

				$sup = mysqli_query($conn, "SELECT * FROM stok JOIN barang on stok.id_barang = barang.id_barang");
				while ($lstok = mysqli_fetch_Assoc($sup)) :;

				?>
					<table cellpadding="5" class="mb-2">
						<tr>
							<td>Kode Barang</td>
							<td>:</td>
							<td><?= $lstok['id_barang'] ?></td>
						</tr>
						<td>Barang</td>
						<td>:</td>
						<td><?= $lstok['nama_barang'] ?></td>
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
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$query = mysqli_query($conn, "SELECT * FROM kartu_stok 
								JOIN barang ON kartu_stok.id_barang = barang.id_barang
								JOIN supplier ON kartu_stok.id_supplier = supplier.id_supplier
								JOIN sales ON kartu_stok.id_sales = sales.id_sales
								JOIN pelanggan ON kartu_stok.id_pelanggan = pelanggan.id_pelanggan
								WHERE kartu_stok.id_barang = '$lstok[id_barang]'");

							while ($lihat = mysqli_fetch_Assoc($query)) :;

							?>
								<tr>
									<td><?= date('d M Y / H:i', strtotime($lihat['tgl_kartu_stok'])) ?></td>
									<td><?= $lihat['nama_supplier'] ?></td>
									<td><?= $lihat['nama_sales'] ?></td>
									<td><?= $lihat['nama_pelanggan'] ?></td>
									<?php if ($lihat['jumlah_masuk'] == 0) : ?>
										<td style="color: lightgrey" align="center"><?= $lihat['jumlah_masuk'] ?></td>
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
					</table><br>
				<?php endwhile ?>
			<?php endif ?>



			<!--================================================= untuk cetak barang ============================================-->

			<?php if ($index == "cetak_barang") : ?>
				<?php
				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Kode Barang</td>
						<td>:</td>
						<td><?= $id_barang ?></td>
					</tr>
					<td>Barang</td>
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


						$query = mysqli_query($conn, "SELECT * FROM kartu_stok 
							JOIN barang ON kartu_stok.id_barang = barang.id_barang
							JOIN supplier ON kartu_stok.id_supplier = supplier.id_supplier
							JOIN sales ON kartu_stok.id_sales = sales.id_sales
							JOIN pelanggan ON kartu_stok.id_pelanggan = pelanggan.id_pelanggan
							WHERE kartu_stok.id_barang = '$id_barang'");


						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y / H:i:s', strtotime($lihat['tgl_kartu_stok'])) ?></td>
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
			<?php endif ?>



			<!--================================================= untuk cetak tanggal =======================================-->

			<?php if ($index == "cetak_tanggal") : ?>
				<?php

				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal'])) . ' ' . '01:00:00';
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir'])) . ' ' . '23:00:00';

				$tgl_a = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_r = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				?>

				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_a == $tgl_r) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<?php

				$sup = mysqli_query($conn, "SELECT DISTINCT id_barang FROM kartu_stok WHERE tgl_kartu_stok BETWEEN '$tgl_awal' AND '$tgl_akhir'");
				while ($lstok = mysqli_fetch_Assoc($sup)) :;

					$b = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id_barang = '$lstok[id_barang]'");
					$lb = mysqli_fetch_assoc($b);

				?>
					<table cellpadding="5" class="mb-2">
						<tr>
							<td>Kode Barang</td>
							<td>:</td>
							<td><?= $lstok['id_barang'] ?></td>
						</tr>
						<td>Barang</td>
						<td>:</td>
						<td><?= $lb['nama_barang'] ?></td>
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
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$query = mysqli_query($conn, "SELECT * FROM kartu_stok 
								JOIN barang ON kartu_stok.id_barang = barang.id_barang
								JOIN supplier ON kartu_stok.id_supplier = supplier.id_supplier
								JOIN sales ON kartu_stok.id_sales = sales.id_sales
								JOIN pelanggan ON kartu_stok.id_pelanggan = pelanggan.id_pelanggan
								WHERE kartu_stok.id_barang = '$lstok[id_barang]' AND tgl_kartu_stok BETWEEN '$tgl_awal' AND '$tgl_akhir'");

							while ($lihat = mysqli_fetch_Assoc($query)) :;

							?>
								<tr>
									<td><?= date('d M Y / H:i:s', strtotime($lihat['tgl_kartu_stok'])) ?></td>
									<td><?= $lihat['nama_supplier'] ?></td>
									<td><?= $lihat['nama_sales'] ?></td>
									<td><?= $lihat['nama_pelanggan'] ?></td>
									<?php if ($lihat['jumlah_masuk'] == 0) : ?>
										<td style="color: lightgrey" align="center"><?= $lihat['jumlah_masuk'] ?></td>
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
					</table><br>
				<?php endwhile ?>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal barang =======================================-->

			<?php if ($index == "cetak_tanggal_barang") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal'])) . ' ' . '01:00:00';
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir'])) . ' ' . '23:00:00';

				$tgl_a = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_r = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>

				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_a == $tgl_r) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Kode Barang</td>
						<td>:</td>
						<td><?= $id_barang ?></td>
					</tr>
					<td>Barang</td>
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
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query = mysqli_query($conn, "SELECT * FROM kartu_stok 
							JOIN barang ON kartu_stok.id_barang = barang.id_barang
							JOIN supplier ON kartu_stok.id_supplier = supplier.id_supplier
							JOIN sales ON kartu_stok.id_sales = sales.id_sales
							JOIN pelanggan ON kartu_stok.id_pelanggan = pelanggan.id_pelanggan
							WHERE kartu_stok.id_barang = '$id_barang' AND tgl_kartu_stok BETWEEN '$tgl_awal' AND '$tgl_akhir'");

						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y / H:i:s', strtotime($lihat['tgl_kartu_stok'])) ?></td>
								<td><?= $lihat['nama_supplier'] ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
								<?php if ($lihat['jumlah_masuk'] == 0) : ?>
									<td style="color: lightgrey" align="center"><?= $lihat['jumlah_masuk'] ?></td>
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
			<?php endif ?>

		</div>
	</form>
</body>

</html>


<?php if (isset($_POST['cetak'])) {

	echo "<script>window.print()</script>";
} ?>