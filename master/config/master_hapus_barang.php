<?php
include '../../config/koneksi.php';
$id_barang = $_GET['id_barang'];

$query = mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$id_barang'");

echo "<script>location='../m_barang.php'</script>";
