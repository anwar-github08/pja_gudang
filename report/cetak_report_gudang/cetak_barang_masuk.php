<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report Barang Masuk</title>

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
				<h4 align="center">Barang Masuk</h5>
			</div>
			<hr>

			<?php $index = $_GET['index']; ?>



			<button type="submit" name="cetak" class="btn btn-info btn-sm" id="cetak">Cetak</button>
			<button type="submit" name="excel" class="btn btn-success btn-sm" id="cetak">Excel</button>
			<a href="javascript:window.history.go(-1);" class="btn btn-danger btn-sm" id="cetak">Kembali</a><br><br>

			<?php if (isset($_POST['excel'])) {

				header("Content-type: application/vnd-ms-excel");
				header("Content-Disposition: attachment; filename=barang masuk.xls");
			} ?>






			<!--================================================= untuk cetak semua data ============================================-->

			<?php if ($index == "cetak_semua") : ?>

				<!-- untuk ambil data tanggal dan supplier di tabel transaksi tabel 1-->
				<?php
				$sup = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier on transaksi_barang_masuk.id_supplier = supplier.id_supplier ORDER BY tanggal ASC");
				while ($lsup = mysqli_fetch_Assoc($sup)) :;
				?>

					<table class="mb-2" cellpadding="5">
						<tr>
							<td>Tanggal</td>
							<td>: <?= date('d M Y / H:i:s', strtotime($lsup['tanggal'])) ?></td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td>: <?= $lsup['nama_supplier'] ?></td>
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
							$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = $lsup[id_transaksi_barang_masuk]");
							while ($lihat = mysqli_fetch_Assoc($query)) :;

							?>
								<tr>
									<td><?= $lihat['nama_barang'] ?></td>
									<td align="center"><?= $lihat['jumlah'] ?></td>
								</tr>
							<?php endwhile ?>
						</tbody>
					</table><br>
				<?php endwhile ?>
			<?php endif ?>







			<!--================================================= untuk cetak supllier ============================================-->

			<?php if ($index == "cetak_supplier") : ?>
				<?php
				$id_supplier = $_GET['id_supplier'];
				$nama_supplier = $_GET['nama_supplier'];
				?>

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Supplier</td>
						<td>:</td>
						<td><?= $nama_supplier ?></td>
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
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE barang_masuk.id_supplier = '$id_supplier'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>









			<!--================================================= untuk cetak tanggal ============================================-->

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

				<!-- untuk ambil data tanggal dan supplier di tabel transaksi tabel 1-->
				<?php
				$sup = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier on transaksi_barang_masuk.id_supplier = supplier.id_supplier WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
				while ($lsup = mysqli_fetch_Assoc($sup)) :;
				?>
					<table class="mb-2" cellpadding="5">
						<tr>
							<td>Tanggal</td>
							<td>: <?= date('d M Y', strtotime($lsup['tanggal'])) ?></td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td>: <?= $lsup['nama_supplier'] ?></td>
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
							$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = $lsup[id_transaksi_barang_masuk] AND tanggal BETWEEN '$tgl_a' AND '$tgl_r'");
							while ($lihat = mysqli_fetch_Assoc($query)) :;

							?>
								<tr>
									<td><?= $lihat['nama_barang'] ?></td>
									<td align="center"><?= $lihat['jumlah'] ?></td>
								</tr>
							<?php endwhile ?>
						</tbody>
					</table><br>
				<?php endwhile ?>
			<?php endif ?>






			<!--============================================== untuk cetak tanggal dan supplier ======================================-->

			<?php if ($index == "cetak_tanggal_supplier") : ?>

				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_supplier = $_GET['id_supplier'];
				$nama_supplier = $_GET['nama_supplier'];
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

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Supplier</td>
						<td>:</td>
						<td><?= $nama_supplier ?></td>
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
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang JOIN supplier ON barang_masuk.id_supplier = supplier.id_supplier WHERE barang_masuk.id_supplier = '$id_supplier' AND tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td><?= $lihat['nama_barang'] ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>





			<!--============================================== untuk cetak barang =========================================-->

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
							<th>Supplier</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN supplier ON barang_masuk.id_supplier = supplier.id_supplier WHERE barang_masuk.id_barang = '$id_barang'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td><?= $lihat['nama_supplier'] ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>





			<!--============================================== untuk cetak barang dan supplier =====================================-->

			<?php if ($index == "cetak_barang_supplier") : ?>
				<?php
				$id_barang = $_GET['id_barang'];
				$nama_barang = $_GET['nama_barang'];

				$id_supplier = $_GET['id_supplier'];
				$nama_supplier = $_GET['nama_supplier'];
				?>

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Supplier</td>
						<td>:</td>
						<td><?= $nama_supplier ?></td>
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
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE id_supplier = '$id_supplier' AND id_barang = '$id_barang'");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>





			<!--============================================== untuk cetak tanggal dan barang =====================================-->

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
							<th>Supplier</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN supplier ON barang_masuk.id_supplier = supplier.id_supplier WHERE barang_masuk.id_barang = '$id_barang' AND tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td><?= $lihat['nama_supplier'] ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
							</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			<?php endif ?>






			<!--====================================== untuk cetak tanggal supplier dan barang ===================================-->

			<?php if ($index == "cetak_tanggal_supplier_barang") : ?>


				<?php
				$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
				$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));

				$id_supplier = $_GET['id_supplier'];
				$nama_supplier = $_GET['nama_supplier'];

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

				<!-- tabel 1 -->
				<table cellpadding="5" class="mb-2">
					<tr>
						<td>Supplier</td>
						<td>:</td>
						<td><?= $nama_supplier ?></td>
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
						$query = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE id_barang = '$id_barang' AND id_supplier = '$id_supplier' AND tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal ASC");
						while ($lihat = mysqli_fetch_Assoc($query)) :;

						?>
							<tr>
								<td><?= date('d M Y', strtotime($lihat['tanggal'])) ?></td>
								<td align="center"><?= $lihat['jumlah'] ?></td>
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