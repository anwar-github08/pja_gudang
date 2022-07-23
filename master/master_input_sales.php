<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Master Sales</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../aset/css/my_style.css">

	<link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>
	<form method="post">

		<?php include '../a_navbar.php'; ?>

		<br>
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4 align="center">Tambah Master Sales</h4>
				</div>
				<div class="card-body">

					<!-- kode otomatis -->
					<?php
					$query = mysqli_query($conn, "SELECT MAX(id_sales) as maxID FROM sales");
					$data = mysqli_fetch_assoc($query);
					$maxid = $data['maxID'];
					$urut = (int) substr($maxid, 4);
					$urut++;
					$char = 'SAL-';
					$id_sales = $char . sprintf("%06s", $urut++);
					?>
					<!-- end -->

					<label>Kode Sales</label>
					<input type="text" name="id_sales" class="form-control mb-3" value="<?= $id_sales ?>" autocomplete="off" readonly>

					<label>Nama Sales</label>
					<input type="text" name="nama_sales" class="form-control mb-3" placeholder="Nama Sales" autocomplete="off" required>

					<label>Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>

					<label>Telp</label>
					<input type="text" name="telp" class="form-control mb-3" placeholder="Telp" onkeypress="return hanyaAngka(event)" autocomplete="off">

					<div class="card-footer text-muted">
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
						<a href="m_sales.php" class="btn btn-danger">Batal</a>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php include '../a_footer.php'; ?>

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

	$id_sales = strtoupper($_POST['id_sales']);
	$nama_sales = strtoupper($_POST['nama_sales']);
	$alamat = strtoupper($_POST['alamat']);
	$telp = $_POST['telp'];

	// validasi jika id sales sudah ada di db

	$querya = mysqli_query($conn, "SELECT * FROM sales WHERE id_sales = '$id_sales'");

	if (mysqli_num_rows($querya) == 1) {

		echo "<script>alert('Kode sales sudah digunakan..!!');location=''</script>";
	} else {


		$query = mysqli_query($conn, "INSERT INTO sales VALUES('$id_sales','$nama_sales','$alamat','$telp')");

		echo "<script>location='m_sales.php'</script>";
	}
}


?>