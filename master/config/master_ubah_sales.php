<?php
include '../../config/koneksi.php';
$id_sales = strtoupper($_POST['id_sales']);
$nama_sales = strtoupper($_POST['nama_sales']);
$alamat = strtoupper($_POST['alamat']);
$telp = $_POST['telp'];


$query = mysqli_query($conn, "UPDATE sales SET nama_sales = '$nama_sales', alamat_sales = '$alamat', telp_sales = '$telp' WHERE id_sales = '$id_sales'");

echo "<script>location='../m_sales.php'</script>";
