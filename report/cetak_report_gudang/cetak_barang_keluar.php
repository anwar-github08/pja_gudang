<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Barang Keluar</title>

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
				<h4 align="center">Barang Keluar</h5>
			</div>
			<hr>

			<?php $index = $_GET['index']; ?>



			<button type="submit" name="cetak" class="btn btn-info btn-sm" id="cetak">Cetak</button>
			<button type="submit" name="excel" class="btn btn-success btn-sm" id="cetak">Excel</button>
			<a href="javascript:window.history.go(-1);" class="btn btn-danger btn-sm" id="cetak">Kembali</a><br><br>

			<?php if (isset($_POST['excel'])) {

				header("Content-type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename=barang keluar.xls");
			} ?>

			<!--================================================= untuk cetak semua data ============================================-->

			<?php if ($index == "cetak_semua") : ?>

				<!-- tabel 1 -->
				<?php

				$sup = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales on transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan on transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan ORDER BY tanggal_keluar ASC");
				while ($lsup = mysqli_fetch_Assoc($sup)) :;

				?>
					<table cellpadding="5" class="mb-2">
						<tr>
							<td>Tanggal</td>
							<td>: <?= date('d M Y', strtotime($lsup['tanggal_keluar'])) ?></td>
						</tr>
						<tr>
							<td>Sales</td>
							<td>: <?= $lsup['nama_sales'] ?></td>
						</tr>
						<tr>
							<td>Pelanggan</td>
							<td>: <?= $lsup['nama_pelanggan'] ?></td>
						</tr>
					</table>

					<!-- tabel 2 -->
					<table border="1" cellpadding="10" width="100%">
						<thead align="center">
							<tr>
								<th width="70%">Barang</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang WHERE id_transaksi_barang_keluar = $lsup[id_transaksi_barang_keluar]");
							while ($lihat = mysqli_fetch_Assoc($query)) :;
							?>
								<tr>
									<td><?= $lihat['nama_barang'] ?></td>
									<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								</tr>
							<?php endwhile ?>
						</tbody>
					</table><br>
				<?php endwhile ?>
			<?php endif ?>



			<!--================================================= untuk cetak pelanggan ============================================-->

			<?php if ($index == "cetak_pelanggan") : ?>
				<?php
				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];
				?>

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
							<th>Sales</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang JOIN sales ON barang_keluar.id_sales = sales.id_sales WHERE barang_keluar.id_pelanggan = '$id_pelanggan'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>



			<!--================================================= untuk cetak sales ===============================================-->

			<?php if ($index == "cetak_sales") : ?>
				<?php
				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];
				?>
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
							<th>Pelanggan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang JOIN pelanggan ON barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE barang_keluar.id_sales = '$id_sales'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>




			<!--================================================= untuk cetak barang ===============================================-->

			<?php if ($index == "cetak_barang") : ?>
				<?php
				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
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
							<th>Sales</th>
							<th>Pelanggan</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN pelanggan ON barang_keluar.id_pelanggan = pelanggan.id_pelanggan JOIN sales ON barang_keluar.id_sales = sales.id_sales WHERE id_barang = '$id_barang'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>




			<!--================================================= untuk cetak sales barang ==========================================-->

			<?php if ($index == "cetak_sales_barang") : ?>
				<?php
				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
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
							<th>Pelanggan</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN pelanggan ON barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE barang_keluar.id_sales = '$id_sales' AND id_barang = '$id_barang' ");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>




			<!--================================================= untuk cetak pelanggan barang ==========================================-->

			<?php if ($index == "cetak_pelanggan_barang") : ?>
				<?php
				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
					<tr>
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
							<th>Sales</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN sales ON barang_keluar.id_sales = sales.id_sales WHERE barang_keluar.id_pelanggan = '$id_pelanggan' AND id_barang = '$id_barang' ");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>





			<!--================================================= untuk cetak sales pelanggan ==========================================-->

			<?php if ($index == "cetak_sales_pelanggan") : ?>
				<?php
				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];
				?>
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang WHERE id_sales = '$id_sales' AND id_pelanggan = '$id_pelanggan'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>






			<!--============================================== untuk cetak sales pelanggan barang ================================-->

			<?php if ($index == "cetak_sales_pelanggan_barang") : ?>
				<?php
				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
					<tr>
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
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_sales = '$id_sales' AND id_pelanggan = '$id_pelanggan' AND id_barang = '$id_barang' ");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>






			<!--================================================= untuk cetak tanggal ===============================================-->

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

				<!-- tabel 1 -->
				<?php
				$sup = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales on transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan on transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
				while ($lsup = mysqli_fetch_Assoc($sup)) :;
				?>
					<table cellpadding="5" class="mb-2">
						<tr>
							<td>Tanggal</td>
							<td>: <?= date('d M Y', strtotime($lsup['tanggal_keluar'])) ?></td>
						</tr>
						<tr>
							<td>Sales</td>
							<td>: <?= $lsup['nama_sales'] ?></td>
						</tr>
						<tr>
							<td>Pelanggan</td>
							<td>: <?= $lsup['nama_pelanggan'] ?></td>
						</tr>
					</table>

					<!-- tabel 2 -->
					<table border="1" cellpadding="10" width="100%">
						<thead align="center">
							<tr>
								<th>Barang</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang WHERE id_transaksi_barang_keluar = $lsup[id_transaksi_barang_keluar] AND tanggal_keluar BETWEEN '$tgl_a' AND '$tgl_r'");
							while ($lihat = mysqli_fetch_Assoc($query)) :;
							?>
								<tr>
									<td><?= $lihat['nama_barang'] ?></td>
									<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								</tr>
							<?php endwhile ?>
						</tbody>
					</table><br>
				<?php endwhile ?>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal pelanggan ========================================-->

			<?php if ($index == "cetak_tanggal_pelanggan") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
							<th>Sales</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang JOIN sales ON barang_keluar.id_sales = sales.id_sales WHERE barang_keluar.id_pelanggan = '$id_pelanggan' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal sales ========================================-->

			<?php if ($index == "cetak_tanggal_sales") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
							<th>Pelanggan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang JOIN pelanggan ON barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE barang_keluar.id_sales = '$id_sales' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal barang ========================================-->

			<?php if ($index == "cetak_tanggal_barang") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
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
							<th>Sales</th>
							<th>Pelanggan</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN pelanggan ON barang_keluar.id_pelanggan = pelanggan.id_pelanggan JOIN sales ON sales.id_sales = barang_keluar.id_sales WHERE id_barang = '$id_barang' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal pelanggan barang ===============================-->

			<?php if ($index == "cetak_tanggal_pelanggan_barang") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
					<tr>
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
							<th>Sales</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN sales ON sales.id_sales = barang_keluar.id_sales WHERE id_barang = '$id_barang' AND id_pelanggan = '$id_pelanggan' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_sales'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>



			<!--================================================= untuk cetak tanggal sales barang ===============================-->

			<?php if ($index == "cetak_tanggal_sales_barang") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
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
							<th>Pelanggan</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN pelanggan ON pelanggan.id_pelanggan = barang_keluar.id_pelanggan WHERE id_barang = '$id_barang' AND barang_keluar.id_sales = '$id_sales' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_pelanggan'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>




			<!--================================================= untuk cetak tanggal sales pelanggan ===============================-->

			<?php if ($index == "cetak_tanggal_sales_pelanggan") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
				</table>

				<!-- tabel 2 -->
				<table border="1" cellpadding="10" width="100%">
					<thead align="center">
						<tr>

							<th>Tanggal</th>
							<th>Barang</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang.id_barang = barang_keluar.id_barang WHERE id_sales = '$id_sales' AND id_pelanggan = '$id_pelanggan' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>




			<!--==================================== untuk cetak tanggal sales pelanggan barang =======================================-->

			<?php if ($index == "cetak_tanggal_sales_pelanggan_barang") : ?>
				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_sales = $_GET['id_sales'];
				$nama_sales = $_GET['nama_sales'];

				$id_pelanggan = $_GET['id_pelanggan'];
				$nama_pelanggan = $_GET['nama_pelanggan'];

				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];
				?>
				<div class="text-center">
					<strong>
						Periode :
						<?php if ($tgl_awal == $tgl_akhir) : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?>
						<?php else : ?>
							<?= date('d M Y', strtotime($tgl_awal)) ?> &nbsp; s.d &nbsp; <?= date('d M Y', strtotime($tgl_akhir)) ?>
						<?php endif ?>
					</strong>
				</div>

				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Sales</td>
						<td>:</td>
						<td><?= $nama_sales ?></td>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>:</td>
						<td><?= $nama_pelanggan ?></td>
					</tr>
					<tr>
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
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_sales = '$id_sales' AND id_pelanggan = '$id_pelanggan' AND id_barang = '$id_barang' AND tanggal_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_keluar ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal_keluar'])) ?></td>
								<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
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