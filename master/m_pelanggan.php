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
	<link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">

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
						<td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_pelanggan'] ?>">Ubah</a>
							<a href="config/master_hapus_pelanggan.php?id_pelanggan=<?= $lihat['id_pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
						</td>
					<?php endif ?>
				</tr>


				<!-- =========================================== Modal =====================================================-->
				<div class="modal fade" id="modalEdit<?= $lihat['id_pelanggan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="config/master_ubah_pelanggan.php" method="post">

									<?php $query2 = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");	?>

									<label>Sales</label>
									<select name="id_sales" class="form-control mb-3" style="width: 100%">
										<option value="<?= $lihat['id_sales'] ?>"><?= $lihat['nama_sales'] ?></option>
										<?php while ($lihat2 = mysqli_fetch_assoc($query2)) :; ?>
											<option value="<?= $lihat2['id_sales'] ?>"><?= $lihat2['nama_sales'] ?></option>
										<?php endwhile ?>
									</select>

									<label>Kode Pelanggan</label>
									<input type="text" name="id_pelanggan" class="form-control mb-3" value="<?= $lihat['id_pelanggan'] ?>" readonly>

									<label>Nama Pelanggan</label>
									<input type="text" name="nama_pelanggan" class="form-control mb-3" placeholder="Nama Pelanggan" value="<?= $lihat['nama_pelanggan'] ?>" autocomplete="off" required>

									<label>Alamat</label>
									<textarea name="alamat" class="form-control" placeholder="Alamat"><?= $lihat['alamat_pelanggan'] ?></textarea>

									<label>Telp</label>
									<input type="text" name="telp" class="form-control mb-3" placeholder="Telp" value="<?= $lihat['telp_pelanggan'] ?>"" onkeypress=" return hanyaAngka(event)" autocomplete="off">

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