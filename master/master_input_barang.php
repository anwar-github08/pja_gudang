<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tambah Master Barang</title>

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
	$query = mysqli_query($conn, "SELECT * FROM golongan_produk ORDER BY nama_golongan_produk ASC");
	$query1 = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
	?>
	<div class="row justify-content-center">
		<div class="col-md-4 mt-5">
			<div class="card">
				<div class="card-header">
					<h4>Tambah Master Barang</h4>
				</div>
				<div class="card-body">
					<form method="post">

						<label>Golongan Produk</label>
						<select name="id_golongan_produk" class="form-control mb-4">
							<?php while ($lihat = mysqli_fetch_assoc($query)) :; ?>
								<option value="<?= $lihat['id_golongan_produk'] ?>"><?= $lihat['nama_golongan_produk'] ?></option>
							<?php endwhile ?>
						</select>

						<label>Supplier</label>
						<select name="id_supplier" class="form-control mb-4">
							<?php while ($lihat1 = mysqli_fetch_assoc($query1)) :; ?>
								<option value="<?= $lihat1['id_supplier'] ?>"><?= $lihat1['nama_supplier'] ?></option>
							<?php endwhile ?>
						</select>

						<!-- kode otomatis -->
						<?php
						$query = mysqli_query($conn, "SELECT MAX(id_barang) as maxID FROM barang");
						$data = mysqli_fetch_assoc($query);
						$maxid = $data['maxID'];
						$urut = (int) substr($maxid, 4);
						$urut++;
						$char = 'BRG-';
						$id_barang = $char . sprintf("%06s", $urut++);
						?>
						<!-- end -->

						<label>Kode Barang</label>
						<input type="text" name="id_barang" class="form-control mb-3" value="<?= $id_barang ?>" autocomplete="off" readonly>

						<label>Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control mb-3" placeholder="Nama Barang" autocomplete="off" required>

						<label>Satuan</label>
						<select name="satuan" class="form-control mb-3">
							<option value="PCS">PCS</option>
							<option value="BOTOL">BOTOL</option>
							<option value="ZAK">ZAK</option>
						</select>


						<div class="card-footer text-muted">
							<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
							<a href="m_barang.php" class="btn btn-danger">Batal</a>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php include '../a_footer.php'; ?>

	<script src="../aset/select2/dist/js/select2.min.js"></script>

	<script>
		$(document).ready(function() {
			$('select').select2();
		});
	</script>

</body>

</html>



<?php

if (isset($_POST['simpan'])) {

	$id_barang = strtoupper($_POST['id_barang']);
	$id_golongan_produk = $_POST['id_golongan_produk'];
	$id_supplier = $_POST['id_supplier'];
	$nama_barang = strtoupper($_POST['nama_barang']);
	$satuan = $_POST['satuan'];

	// validasi jika id barang sudah ada di db

	$querya = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '$id_barang'");

	if (mysqli_num_rows($querya) == 1) {

		echo "<script>alert('Kode barang sudah digunakan..!!');location=''</script>";
	} else {


		$query = mysqli_query($conn, "INSERT INTO barang VALUES('$id_barang','$id_golongan_produk','$id_supplier','$nama_barang','$satuan')");

		echo "<script>location='m_barang.php'</script>";
	}
}


?>