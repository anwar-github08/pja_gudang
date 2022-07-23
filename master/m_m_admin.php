<!-- <?php include '../config/koneksi.php'; ?>
<form method="post">
	<button type="submit" name="simpan">Buat Admin</button>

	<?php if (isset($_POST['simpan'])) {

		$nama = "Gudang";
		$username = "gudang";
		$password = "gudang";
		$level = "gudang";

		// enkripsi password

		$passwordf = password_hash($password, PASSWORD_DEFAULT);

		// simpan ke db

		mysqli_query($conn, "INSERT INTO admin VALUES('','$nama','$username','$passwordf','$level')");
	} ?> -->