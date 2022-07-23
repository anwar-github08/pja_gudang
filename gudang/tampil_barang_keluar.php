<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Barang Keluar</title>

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

	<h4>Barang Keluar</h4>
	<hr>
	<a href="input_barang_keluar.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
	<form method="POST" class="row p-2">
		<input type="text" name="sort_tgl" id="sort_tgl" class="form-control" placeholder="Tanggal" autocomplete="off" style="width: 30%">
		<button type="submit" class="btn btn-success btn-sm" name="cek_tgl">Cari</button>
		<a href="" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
	</form>
	<table id="tabel_barang" class="table table-striped table-bordered table-dark">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Sales</th>
				<th>Pelanggan</th>
				<th>Detail Barang</th>
				<th>Aksi</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if (isset($_POST['cek_tgl'])) {
				$sort_tgl = date("Y-m-d", strtotime($_POST['sort_tgl']));
				$query = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE date(tanggal_keluar) = '$sort_tgl'");
			} else {
				$query = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan");
			}
			while ($lihat = mysqli_fetch_Assoc($query)) :;

			?>
				<tr>
					<td><?= date('Y-m-d  H:i', strtotime($lihat['tanggal_keluar'])) ?></td>
					<td><?= $lihat['nama_sales'] ?></td>
					<td><?= $lihat['nama_pelanggan'] ?></td>
					<td><a href="detail_barang_keluar.php?id_transaksi_barang_keluar=<?= $lihat['id_transaksi_barang_keluar'] ?>" class="btn btn-info btn-sm">Lihat Barang</a></td>
					<td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_transaksi_barang_keluar'] ?>">Ubah</a>
						<a href="config/hapus_transaksi_barang_keluar.php?id_transaksi_barang_keluar=<?= $lihat['id_transaksi_barang_keluar'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
					</td>

				</tr>



				<!-- =========================================== Modal =====================================================-->
				<div class="modal fade" id="modalEdit<?= $lihat['id_transaksi_barang_keluar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form action="config/ubah_transaksi_barang_keluar.php" method="post">

									<?php
									$querys = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
									$queryp = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
									?>
									<label>Tanggal</label>
									<input type="text" name="tgl" id="tgl" class="form-control mb-3" value="<?= date('d-m-Y', strtotime($lihat['tanggal_keluar'])) ?>" placeholder="Tanggal" autocomplete="off" required>

									<label>Sales</label>
									<select name="id_sales" size="1" class="form-control mb-3" style="width: 100%">
										<option value="<?= $lihat['id_sales'] ?>"><?= $lihat['nama_sales'] ?></option>

										<?php while ($lihats = mysqli_fetch_assoc($querys)) :; ?>
											<option value="<?= $lihats['id_sales'] ?>"><?= $lihats['nama_sales'] ?></option>
										<?php endwhile ?>
									</select>

									<label>Pelanggan</label>
									<select name="id_pelanggan" size="1" class="form-control mb-3" style="width: 100%">
										<option value="<?= $lihat['id_pelanggan'] ?>"><?= $lihat['nama_pelanggan'] ?></option>

										<?php while ($lihatp = mysqli_fetch_assoc($queryp)) :; ?>
											<option value="<?= $lihatp['id_pelanggan'] ?>"><?= $lihatp['nama_pelanggan'] ?></option>
										<?php endwhile ?>
									</select>

									<input type="hidden" name="waktu" value="<?= date('H:i:s', strtotime($lihat['tanggal_keluar'])) ?>">
									<input type="text" name="id_transaksi_barang_keluar" value="<?= $lihat['id_transaksi_barang_keluar'] ?>">

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
			var table = $('#tabel_barang').DataTable();
		});
	</script>

</body>

</html>