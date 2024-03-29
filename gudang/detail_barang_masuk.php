<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Detail Barang Masuk</title>

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
	$id_transaksi_barang_masuk = $_GET['id_transaksi_barang_masuk'];

	$query1 = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier ON transaksi_barang_masuk.id_supplier = supplier.id_supplier WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
	$lihat1 = mysqli_fetch_Assoc($query1);

	?>
	<h4>Detail Barang Masuk</h4>
	<hr>
	<a href="cetak_excel/excel_detail_barang_masuk.php?id_transaksi_barang_masuk=<?= $id_transaksi_barang_masuk ?>" target="blank" class="btn btn-success btn-sm">Excel</a>
	<a href="cetak_pdf/cetak_detail_barang_masuk.php?id_transaksi_barang_masuk=<?= $id_transaksi_barang_masuk ?>" target="blank" class="btn btn-info btn-sm">Print</a>
	<a href="tampil_barang_masuk.php" class="btn btn-danger btn-sm">Kembali</a><br>

	<table cellpadding="10">
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><?= date('d M Y / H:i', strtotime($lihat1['tanggal'])) ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $lihat1['nama_supplier'] ?></td>
		</tr>
	</table>

	<table class="table table-striped table-dark" id="tblexcel">
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
			$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $lihat['nama_barang'] ?></td>
					<td><?= $lihat['jumlah'] ?></td>
					<td>
						<a href="ubah_br_masuk.php?id=<?= $lihat['id_barang_masuk'] ?>" type="button" class="btn btn-warning btn-sm">Ubah</a>
						<a href="config/hapus_barang_masuk.php?id_barang_masuk=<?= $lihat['id_barang_masuk'] ?>&id_tr_barang_masuk=<?= $lihat['id_transaksi_barang_masuk'] ?>&id_barang=<?= $lihat['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
					</td>
				</tr>

			<?php endwhile ?>
		</tbody>
	</table>

	<?php include '../a_footer.php'; ?>
</body>

</html>