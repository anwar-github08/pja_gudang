<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Retur / Turun Gudang</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">

	<!-- untuk datatables -->
	<link rel="stylesheet" href="../aset/datatables/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../aset/datatables/button/css/buttons.bootstrap4.min.css">

	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

	<?php include '../a_navbar.php'; ?>

	<h4>Retur & Turun Gudang</h4>
	<hr>
	<a href="input_retur.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
	<form method="POST" class="row p-2">
		<input type="text" name="sort_tgl" id="sort_tgl" class="form-control" placeholder="Tanggal" autocomplete="off" style="width: 30%">
		<button type="submit" class="btn btn-success btn-sm" name="cek_tgl">Cari</button>
		<a href="" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
	</form>
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Nama</th>
				<th>Jumlah</th>
				<th>Keterangan</th>
				<th>Aksi</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if (isset($_POST['cek_tgl'])) {
				$sort_tgl = date("Y-m-d", strtotime($_POST['sort_tgl']));
				$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = 0 AND tanggal = '$sort_tgl' ");
			} else {
				$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = 0");
			}
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= date('Y-m-d', strtotime($lihat['tanggal'])) ?></td>
					<td><?= $lihat['nama_barang'] ?></td>
					<td><?= $lihat['jumlah'] ?></td>
					<td><?= $lihat['keterangan_masuk'] ?></td>
					<td><a href="ubah_retur.php?id=<?= $lihat['id_barang_masuk'] ?>" type="button" class="btn btn-warning btn-sm">Ubah</a>
						<a href="config/hapus_retur.php?id_barang_masuk=<?= $lihat['id_barang_masuk'] ?>&id_barang=<?= $lihat['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
					</td>
				</tr>

			<?php endwhile ?>

		</tbody>
	</table>

	<?php include '../a_footer.php'; ?>

	<script src="../aset/tgl/flatpickr.js"></script>

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

	<script>
		flatpickr("#sort_tgl", {
			dateFormat: 'd-m-Y'
		});
	</script>

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