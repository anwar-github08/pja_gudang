<?php
include '../../config/koneksi.php';
$id_pelanggan = $_GET['id_pelanggan'];

$query = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

echo "<script>location='../m_pelanggan.php'</script>";
