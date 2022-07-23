<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Detail Barang Kelompok Produk</title>

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
	$id_golongan_produk = $_GET['id_golongan_produk'];
	$query1 = mysqli_query($conn, "SELECT * FROM golongan_produk WHERE id_golongan_produk = '$id_golongan_produk'");
	$lihat1 = mysqli_fetch_Assoc($query1);

	?>
	<h4>Detail Barang Kelompok Produk</h4>
	<hr>

	<table cellpadding="10">
		<tr>
			<td>Kode Kelompok Produk</td>
			<td>:</td>
			<td><?= $lihat1['id_golongan_produk'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $lihat1['nama_golongan_produk'] ?></td>
		</tr>
	</table>

	<table class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Barang</th>
				<th>Nama</th>
				<th>Satuan</th>
				<th>Supplier</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = mysqli_query($conn, "SELECT * FROM barang JOIN supplier ON barang.id_supplier = supplier.id_supplier WHERE id_golongan_produk = '$id_golongan_produk'");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $lihat['id_barang'] ?></td>
					<td><?= $lihat['nama_barang'] ?></td>
					<td><?= $lihat['satuan'] ?></td>
					<td><?= $lihat['nama_supplier'] ?></td>
				</tr>
			<?php endwhile ?>
		</tbody>
	</table>

	<a href="m_gol_produk.php" class="btn btn-danger">Kembali</a>

	<?php include '../a_footer.php'; ?>

</body>

</html>