<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Master Supplier</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

	<div class="row justify-content-center">
		<div class="col-md-4 mt-5">
			<div class="card">
				<div class="card-header">
					<h4>Tambah Master Supplier</h4>
				</div>
				<div class="card-body">
					<form method="post">

						<!-- kode otomatis -->
						<?php
						$query = mysqli_query($conn, "SELECT MAX(id_supplier) as maxID FROM supplier");
						$data = mysqli_fetch_assoc($query);
						$maxid = $data['maxID'];
						$urut = (int) substr($maxid, 4);
						$urut++;
						$char = 'SUP-';
						$id_supplier = $char . sprintf("%06s", $urut++);
						?>
						<!-- end -->

						<label>Kode Supplier</label>
						<input type="text" name="id_supplier" class="form-control mb-3" value="<?= $id_supplier ?>" autocomplete="off" readonly>

						<label>Nama Supplier</label>
						<input type="text" name="nama_supplier" class="form-control mb-3" placeholder="Nama Supplier" autocomplete="off" required>

						<label>Alamat</label>
						<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>

						<label>Telp</label>
						<input type="text" name="telp" class="form-control mb-3" placeholder="Telp" onkeypress="return hanyaAngka(event)" autocomplete="off">

						<label>Email</label>
						<input type="text" name="email" class="form-control mb-3" placeholder="Email" autocomplete="off">

						<div class="card-footer text-muted">
							<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
							<a href="m_supplier.php" class="btn btn-danger">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include '../a_footer.php'; ?>

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

	$id_supplier = strtoupper($_POST['id_supplier']);
	$nama_supplier = strtoupper($_POST['nama_supplier']);
	$alamat = strtoupper($_POST['alamat']);
	$telp = $_POST['telp'];
	$email = $_POST['email'];

	// validasi jika id supplier sudah ada di db

	$querya = mysqli_query($conn, "SELECT * FROM supplier WHERE id_supplier = '$id_supplier'");

	if (mysqli_num_rows($querya) == 1) {

		echo "<script>alert('Kode supplier sudah digunakan..!!');location=''</script>";
	} else {


		$query = mysqli_query($conn, "INSERT INTO supplier VALUES('$id_supplier','$nama_supplier','$alamat','$telp','$email')");

		echo "<script>location='m_supplier.php'</script>";
	}
}
?>