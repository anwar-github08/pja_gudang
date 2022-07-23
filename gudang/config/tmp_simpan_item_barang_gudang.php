<?php include '../../config/koneksi.php';

$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];

mysqli_query($conn, "INSERT INTO tmp_barang_gudang VALUES('','$id_barang','$jumlah')");
