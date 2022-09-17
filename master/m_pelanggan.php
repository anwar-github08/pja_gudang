<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Master Pelanggan</title>

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

	<h4>Master Pelanggan</h4>
	<hr>
	<a href="master_input_pelanggan.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Kode Pelanggan</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Sales</th>
				<th>Telp</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = mysqli_query($conn, "SELECT * FROM pelanggan JOIN sales ON pelanggan.id_sales = sales.id_sales ORDER BY nama_pelanggan ASC");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $lihat['id_pelanggan'] ?></td>
					<td><?= $lihat['nama_pelanggan'] ?></td>
					<td><?= $lihat['alamat_pelanggan'] ?></td>
					<td><?= $lihat['nama_sales'] ?></td>
					<td><?= $lihat['telp_pelanggan'] ?></td>
					<?php if ($lihat['id_pelanggan'] == '-') : ?>
						<td></td>
					<?php else : ?>
						<td><a href="master_ubah_pelanggan.php?id=<?= $lihat['id_pelanggan'] ?>" type="button" class="btn btn-warning btn-sm">Ubah</a>
							<a href="config/master_hapus_pelanggan.php?id_pelanggan=<?= $lihat['id_pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
						</td>
					<?php endif ?>
				</tr>

			<?php endwhile ?>
		</tbody>
	</table>

	<?php include '../a_footer.php'; ?>

	<script src="../aset/select2/dist/js/select2.min.js"></script>

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

	<!--hanya angka -->
	<script>
		function hanyaAngka(evt) {
			var kode = (evt.which) ? evt.which : event.keyCode
			if (kode > 31 && (kode < 48 || kode > 57))

				return false;
			return true;
		}
	</script>

	<!-- select2 -->
	<script>
		$(document).ready(function() {
			$('select').select2();
		});
	</script>


	<!-- datatables -->
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