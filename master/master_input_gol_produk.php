<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Master Kelompok Produk</title>

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
					<h4 align="center">Tambah Master Kelompok Produk</h4>
				</div>
				<div class="card-body">

					<!-- kode otomatis -->
					<?php
					$query = mysqli_query($conn, "SELECT MAX(id_golongan_produk) as maxID FROM golongan_produk");
					$data = mysqli_fetch_assoc($query);
					$maxid = $data['maxID'];
					$urut = (int) substr($maxid, 4);
					$urut++;
					$char = 'GOL-';
					$id_golongan_produk = $char . sprintf("%06s", $urut++);
					?>
					<!-- end -->

					<label>Kode Kelompok Produk</label>
					<input type="text" name="id_golongan_produk" class="form-control mb-3" value="<?= $id_golongan_produk ?>" autocomplete="off" readonly>

					<label>Nama Kelompok Produk</label>
					<input type="text" name="nama_golongan_produk" class="form-control mb-3" placeholder="Nama Kel Produk" autocomplete="off" required>

					<div class="card-footer text-muted">
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
						<a href="m_gol_produk.php" class="btn btn-danger">Batal</a>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php include '../a_footer.php'; ?>
</body>

</html>


<?php

if (isset($_POST['simpan'])) {

	$id_golongan_produk = strtoupper($_POST['id_golongan_produk']);
	$nama_golongan_produk = strtoupper($_POST['nama_golongan_produk']);

	// validasi jika id supplier sudah ada di db

	$querya = mysqli_query($conn, "SELECT * FROM golongan_produk WHERE id_golongan_produk = '$id_golongan_produk'");

	if (mysqli_num_rows($querya) == 1) {

		echo "<script>alert('Kode golongan produk sudah digunakan..!!');location=''</script>";
	} else {


		$query = mysqli_query($conn, "INSERT INTO golongan_produk VALUES('$id_golongan_produk','$nama_golongan_produk')");

		echo "<script>location='m_gol_produk.php'</script>";
	}
}


?>