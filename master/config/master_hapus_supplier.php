<?php
include '../../config/koneksi.php';
$id_supplier = $_GET['id_supplier'];

$query = mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier = '$id_supplier'");

echo "<script>location='../m_supplier.php'</script>";
