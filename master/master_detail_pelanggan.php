<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>


<!DOCTYPE html>
<html>

<head>
	<title>Detail Pelanggan Per Sales</title>

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
	$id_sales = $_GET['id_sales'];
	$query1 = mysqli_query($conn, "SELECT * FROM sales WHERE id_sales = '$id_sales'");
	$lihat1 = mysqli_fetch_Assoc($query1);

	?>
	<h4>Detail Pelanggan Per Sales</h4>
	<hr>

	<table cellpadding="10">
		<tr>
			<td>Kode Sales</td>
			<td>:</td>
			<td><?= $lihat1['id_sales'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $lihat1['nama_sales'] ?></td>
		</tr>
	</table>

	<table class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Pelanggan</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telp</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_sales = '$id_sales'");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $lihat['id_pelanggan'] ?></td>
					<td><?= $lihat['nama_pelanggan'] ?></td>
					<td><?= $lihat['alamat_pelanggan'] ?></td>
					<td><?= $lihat['telp_pelanggan'] ?></td>
				</tr>
			<?php endwhile ?>
		</tbody>
	</table>

	<a href="m_sales.php" class="btn btn-danger">Kembali</a>

	<?php include '../a_footer.php'; ?>

</body>

</html>