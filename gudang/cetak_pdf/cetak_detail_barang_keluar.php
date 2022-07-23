<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Detail Barang Keluar</title>

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


		<?php
		$id_transaksi_barang_keluar = $_GET['id_transaksi_barang_keluar'];

		$query1 = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
		$lihat1 = mysqli_fetch_Assoc($query1);

		?>

		<div class="container">
			<br><br>
			<img src="../../gambar/pakis22.png" class="img-fluid" width="60%"><br><br><br>
			<hr>

			<h4 align="center">Barang Keluar</h4>
			<hr>

			<table cellpadding="10">
				<tr>
					<td>Tanggal</td>
					<td>:</td>
					<td><?= date('d M Y / H:i', strtotime($lihat1['tanggal_keluar'])) ?></td>
				</tr>
				<tr>
					<td>Nama Sales</td>
					<td>:</td>
					<td><?= $lihat1['nama_sales'] ?></td>
				</tr>
				<tr>
					<td>Nama Pelanggan</td>
					<td>:</td>
					<td><?= $lihat1['nama_pelanggan'] ?></td>
				</tr>
			</table>

			<br>
			<table border="1" cellpadding="10" width="100%">
				<thead align="center">
					<tr>

						<th>Nama Barang</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
					while ($lihat = mysqli_fetch_Assoc($query)) :;

					?>
						<tr>
							<td><?= $lihat['nama_barang'] ?></td>
							<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
						</tr>
					<?php endwhile ?>
				</tbody>
			</table><br>
			<button type="submit" name="cetak" class="btn btn-info btn-sm" id="cetak">Cetak</button>
			<a href="../detail_barang_keluar.php?id_transaksi_barang_keluar=<?= $id_transaksi_barang_keluar ?>" class="btn btn-danger btn-sm" id="cetak">Kembali</a>
		</div>
	</form>

	<div class="col-md-12 mt-5">
		<div class="copyright-area text-center">
			<em>&copy; 2021 CV. Pakis Jaya Abadi .<strong> All Right Reserved</strong></em>
		</div>
	</div>
</body>

</html>


<?php if (isset($_POST['cetak'])) {

	echo "<script>window.print()</script>";
} ?>