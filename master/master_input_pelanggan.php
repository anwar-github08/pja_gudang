<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Master Pelanggan</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/css/my_style.css">

	<!-- select2 -->
	<link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

	<!-- untuk tampil gol produk dan supplier -->
	<?php
	$query = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
	?>

	<div class="row justify-content-center">
		<div class="col-md-4 mt-5">
			<div class="card">
				<div class="card-header">
					<h4>Tambah Master Pelanggan</h4>
				</div>
				<div class="card-body">

					<form method="post">
						<label>Sales</label>
						<select name="id_sales" class="form-control mb-3" id="select2">
							<?php while ($lihat = mysqli_fetch_assoc($query)) :; ?>
								<option value="<?= $lihat['id_sales'] ?>"><?= $lihat['nama_sales'] ?></option>
							<?php endwhile ?>
						</select>

						<!-- kode otomatis -->
						<?php
						$query = mysqli_query($conn, "SELECT MAX(id_pelanggan) as maxID FROM pelanggan");
						$data = mysqli_fetch_assoc($query);
						$maxid = $data['maxID'];
						$urut = (int) substr($maxid, 4);
						$urut++;
						$char = 'PEL-';
						$id_pelanggan = $char . sprintf("%06s", $urut++);
						?>
						<!-- end -->

						<label>Kode Pelanggan</label>
						<input type="text" name="id_pelanggan" class="form-control mb-3" value="<?= $id_pelanggan ?>" autocomplete="off" readonly>

						<label>Nama Pelanggan</label>
						<input type="text" name="nama_pelanggan" class="form-control mb-3" placeholder="Nama Pelanggan" autocomplete="off" required>

						<label>Alamat</label>
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>

						<label>Telp</label>
						<input type="text" name="telp" class="form-control mb-3" placeholder="Telp" onkeypress="return hanyaAngka(event)" autocomplete="off">


						<div class="card-footer text-muted">
							<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
							<a href="m_pelanggan.php" class="btn btn-danger">Batal</a>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php include '../a_footer.php'; ?>

	<!-- untuk select2 -->
	<script src="../aset/select2/dist/js/select2.min.js"></script>

	<script>
		$(document).ready(function() {
			$('select').select2();
		});
	</script>

	<!-- fungsi javascript hanya angka -->
	<script>
		function hanyaAngka(evt) {

			var kode = (evt.which) ? evt.which : event.keyCode
			if (kode > 31 && (kode < 48 || kode > 57))

				return false;
			return true;
		}
	</script>

</body>

</html>



<?php

if (isset($_POST['simpan'])) {

	$id_pelanggan = strtoupper($_POST['id_pelanggan']);
	$id_sales = $_POST['id_sales'];
	$nama_pelanggan = strtoupper($_POST['nama_pelanggan']);
	$alamat = strtoupper($_POST['alamat']);
	$telp = $_POST['telp'];

	// validasi jika id pelanggan sudah ada di db

	$querya = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

	if (mysqli_num_rows($querya) == 1) {

		echo "<script>alert('Kode pelanggan sudah digunakan..!!');location=''</script>";
	} else {


		$query = mysqli_query($conn, "INSERT INTO pelanggan VALUES('$id_pelanggan','$id_sales','$nama_pelanggan','$alamat','$telp')");

		echo "<script>location='m_pelanggan.php'</script>";
	}
}


?>