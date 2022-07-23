<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Master Sales</title>

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

	<h4>Master Sales</h4>
	<hr>
	<a href="master_input_sales.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Kode Sales</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telp</th>
				<th>Detail Pelanggan</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= $lihat['id_sales'] ?></td>
					<td><?= $lihat['nama_sales'] ?></td>
					<td><?= $lihat['alamat_sales'] ?></td>
					<td><?= $lihat['telp_sales'] ?></td>
					<?php if ($lihat['id_sales'] == '-') : ?>
						<td></td>
						<td></td>
					<?php else : ?>
						<td><a href="master_detail_pelanggan.php?id_sales=<?= $lihat['id_sales'] ?>" class="btn btn-info btn-sm">Detail Pelanggan</a></td>
						<td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_sales'] ?>">Ubah</a> <a href="config/master_hapus_sales.php?id_sales=<?= $lihat['id_sales'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a></td>
					<?php endif ?>
				</tr>

				<!-- =========================================== Modal =====================================================-->
				<div class="modal fade" id="modalEdit<?= $lihat['id_sales'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="config/master_ubah_sales.php" method="post">
									<label>Kode Sales</label>
									<input type="text" name="id_sales" class="form-control mb-3" value="<?= $lihat['id_sales'] ?>" readonly>

									<label>Nama Sales</label>
									<input type="text" name="nama_sales" class="form-control mb-3" placeholder="Nama Sales" value="<?= $lihat['nama_sales'] ?>" autocomplete="off" required>

									<label>Alamat</label>
									<textarea name="alamat" class="form-control" placeholder="Alamat"><?= $lihat['alamat_sales'] ?></textarea>

									<label>Telp</label>
									<input type="text" name="telp" class="form-control mb-3" placeholder="Telp" value="<?= $lihat['telp_sales'] ?>" onkeypress="return hanyaAngka(event)" autocomplete="off">

									<div class="modal-footer">
										<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
										<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- =========================================== END Modal =======================================================-->




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

	<!-- fungsi javascript hanya angka -->
	<script>
		function hanyaAngka(evt) {
			var kode = (evt.which) ? evt.which : event.keyCode
			if (kode > 31 && (kode < 48 || kode > 57))

				return false;
			return true;
		}
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