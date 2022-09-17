<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Detail Barang Keluar</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">
</head>

<body>

	<?php include '../a_navbar.php'; ?>

	<?php
	$id_transaksi_barang_keluar = $_GET['id_transaksi_barang_keluar'];

	$query1 = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
	$lihat1 = mysqli_fetch_Assoc($query1);

	?>

	<h4>Detail Barang Keluar</h4>
	<hr>

	<a href="cetak_excel/excel_detail_barang_keluar.php?id_transaksi_barang_keluar=<?= $id_transaksi_barang_keluar ?>" target="blank" class="btn btn-success btn-sm">Excel</a>
	<a href="cetak_pdf/cetak_detail_barang_keluar.php?id_transaksi_barang_keluar=<?= $id_transaksi_barang_keluar ?>" target="blank" class="btn btn-info btn-sm">Print</a>
	<a href="tampil_barang_keluar.php" class="btn btn-danger btn-sm">Kembali</a>


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

	<table class="table table-striped table-dark">
		<thead>
			<tr>

				<th>Nama</th>
				<th>Jumlah</th>
				<th>Aksi</th>
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
					<td><?= $lihat['jumlah_keluar'] ?></td>
					<td>
						<a href="ubah_br_keluar.php?id=<?= $lihat['id_barang_keluar'] ?>" type="button" class="btn btn-warning btn-sm">Ubah</a>
						<a href="config/hapus_barang_keluar.php?id_barang_keluar=<?= $lihat['id_barang_keluar'] ?>&id_tr_barang_keluar=<?= $lihat['id_transaksi_barang_keluar'] ?>&id_barang=<?= $lihat['id_barang'] ?>" class=" btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
					</td>
				</tr>
			<?php endwhile ?>
		</tbody>
	</table>

	<?php include '../a_footer.php'; ?>
</body>

</html>