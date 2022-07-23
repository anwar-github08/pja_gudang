<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Barang Masuk</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">

	<!-- untuk datatables -->
	<link rel="stylesheet" href="../aset/datatables/datatables/css/dataTables.bootstrap4.min.css">

	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

	<?php include '../a_navbar.php'; ?>

	<h4>Barang Masuk</h4>
	<hr>
	<a href="input_barang_masuk.php" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i> Tambah</a>

	<form method="POST" class="row p-2">
		<input type="text" name="sort_tgl" id="sort_tgl" class="form-control" placeholder="Tanggal" autocomplete="off" style="width: 30%">
		<button type="submit" class="btn btn-success btn-sm" name="cek_tgl">Cari</button>
		<a href="" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
	</form>
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Supplier</th>
				<th>Detail Barang</th>
				<th>Aksi</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if (isset($_POST['cek_tgl'])) {
				$sort_tgl = date("Y-m-d", strtotime($_POST['sort_tgl']));
				$query = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier ON transaksi_barang_masuk.id_supplier = supplier.id_supplier WHERE date(tanggal) = '$sort_tgl'");
			} else {
				$query = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier ON transaksi_barang_masuk.id_supplier = supplier.id_supplier");
			}
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<!-- <td ><?= $lihat['tanggal'] ?></td> -->
					<td><?= date('Y-m-d  H:i', strtotime($lihat['tanggal'])) ?></td>
					<td><?= $lihat['nama_supplier'] ?></td>
					<td><a href="detail_barang_masuk.php?id_transaksi_barang_masuk=<?= $lihat['id_transaksi_barang_masuk'] ?>" class="btn btn-info btn-sm">Lihat Barang</a></td>
					<td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_transaksi_barang_masuk'] ?>">Ubah</a>
						<a href="config/hapus_transaksi_barang_masuk.php?id_transaksi_barang_masuk=<?= $lihat['id_transaksi_barang_masuk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
					</td>

				</tr>

				<!-- =========================================== Modal =====================================================-->
				<div class="modal fade" id="modalEdit<?= $lihat['id_transaksi_barang_masuk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="config/ubah_transaksi_barang_masuk.php" method="post">

									<!-- untuk tampil tanggal dan supplier -->
									<?php
									$query2 = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
									?>
									<label>Tanggal</label>
									<input type="text" name="tgl" id="tgl" class="form-control mb-3" value="<?= date('d-m-Y', strtotime($lihat['tanggal'])) ?>" placeholder="Tanggal" autocomplete="off" required>

									<label>Supplier</label>
									<select name="id_supplier" size="1" class="form-control mb-3" style="width: 100%">
										<option value="<?= $lihat['id_supplier'] ?>"><?= $lihat['nama_supplier'] ?></option>
										<?php while ($lihat2 = mysqli_fetch_assoc($query2)) :; ?>
											<option value="<?= $lihat2['id_supplier'] ?>"><?= $lihat2['nama_supplier'] ?></option>
										<?php endwhile ?>
									</select>

									<input type="hidden" name="waktu" value="<?= date('H:i:s', strtotime($lihat['tanggal'])) ?>">
									<input type="hidden" name="id_transaksi_barang_masuk" value="<?= $lihat['id_transaksi_barang_masuk'] ?>">

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
	<script src="../aset/tgl/flatpickr.js"></script>

	<!-- untuk datatables -->
	<script src="../aset/datatables/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../aset/datatables/datatables/js/dataTables.bootstrap4.min.js"></script>

	<script>
		$(document).ready(function() {
			$("select[size=1]").select2();
		});
	</script>

	<script>
		flatpickr("#tgl", {
			dateFormat: 'd-m-Y'
		});
		flatpickr("#sort_tgl", {
			dateFormat: 'd-m-Y'
		});
	</script>

	<!-- untuk datatables -->
	<script>
		$(document).ready(function() {
			$('#tabel_barang').DataTable();
		});
	</script>

</body>

</html>