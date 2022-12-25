<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Stok</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">

	<!-- untuk datatables -->
	<link rel="stylesheet" href="../aset/datatables/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../aset/datatables/button/css/buttons.bootstrap4.min.css">

	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

	<?php include '../a_navbar.php'; ?>
	<h4>Stok</h4>
	<hr>
	<a href="stok_awal.php" class="btn btn-primary btn-sm mb-2">Update Stok Manual</a>
	<!-- <a href="input_barang_masuk.php" class="btn btn-primary btn-sm mb-3">Tambah Barang Masuk</a> <a href="input_barang_keluar.php" class="btn btn-danger btn-sm mb-3">Tambah Barang Keluar</a> -->
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Satuan</th>
				<th>Sisa</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = mysqli_query($conn, "SELECT * FROM stok JOIN barang ON stok.id_barang = barang.id_barang");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $lihat['id_barang'] ?></td>
					<td><?= $lihat['nama_barang'] ?></td>
					<td><?= $lihat['satuan'] ?></td>
					<?php if ($lihat['jumlah'] > 20) : ?>
						<td style="color: greenyellow"><?= $lihat['jumlah'] ?></td>
					<?php endif ?>
					<?php if ($lihat['jumlah'] <= 20 and $lihat['jumlah'] > 10) : ?>
						<td style="color: yellow"><?= $lihat['jumlah'] ?></td>
					<?php endif ?>
					<?php if ($lihat['jumlah'] <= 10) : ?>
						<td style="color: lightcoral"><?= $lihat['jumlah'] ?></td>
					<?php endif ?>
					<td><a href="riwayat_kartu_stok_barang.php?id_barang=<?= $lihat['id_barang'] ?>&nama_barang=<?= $lihat['nama_barang'] ?>" class="btn btn-info btn-sm">Riwayat</a></td>

				</tr>
			<?php endwhile ?>
		</tbody>
	</table>

	<?php include '../a_footer.php'; ?>

	<!-- untuk datatables -->
	<script src="../aset/datatables/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../aset/datatables/datatables/js/dataTables.bootstrap4.min.js"></script>

	<script src="../aset/datatables/button/js/dataTables.buttons.min.js"></script>
	<script src="../aset/datatables/button/js/buttons.bootstrap4.min.js"></script>

	<script src="../aset/datatables/jszip/jszip.min.js"></script>

	<script src="../aset/datatables/pdfmake/pdfmake.js"></script>
	<script src="../aset/datatables/pdfmake/vfs_fonts.js"></script>

	<script src="../aset/datatables/button/js/buttons.html5.min.js"></script>
	<script src="../aset/datatables/button/js/buttons.print.min.js"></script>
	<script src="../aset/datatables/button/js/buttons.colVis.min.js"></script>

	<!-- untuk datatables -->
	<script>
		$(document).ready(function() {
			var table = $('#tabel_barang').DataTable({
				buttons: [{
						extend: 'print',
						exportOptions: {
							columns: [0, 1, 2, 3]
						}
					},
					{
						extend: 'excel',
						exportOptions: {
							columns: [0, 1, 2, 3]
						}
					},
					{
						extend: 'pdf',
						exportOptions: {
							columns: [0, 1, 2, 3]
						}
					},
				]
			});

			table.buttons().container()
				.appendTo('#tabel_barang_wrapper .col-md-6:eq(0)');
		});
	</script>
</body>

</html>