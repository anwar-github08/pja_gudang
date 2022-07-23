<?php
include '../../config/koneksi.php';
$id_pelanggan = strtoupper($_POST['id_pelanggan']);
$id_sales = $_POST['id_sales'];
$nama_pelanggan = strtoupper($_POST['nama_pelanggan']);
$alamat = strtoupper($_POST['alamat']);
$telp = $_POST['telp'];


$query = mysqli_query($conn, "UPDATE pelanggan SET id_sales = '$id_sales', nama_pelanggan = '$nama_pelanggan', alamat_pelanggan = '$alamat', telp_pelanggan = '$telp' WHERE id_pelanggan = '$id_pelanggan'");

echo "<script>location='../m_pelanggan.php'</script>";
