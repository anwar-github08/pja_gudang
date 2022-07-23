<?php
include '../../config/koneksi.php';
$id_sales = $_GET['id_sales'];

$query = mysqli_query($conn, "DELETE FROM sales WHERE id_sales = '$id_sales'");

echo "<script>location='../m_sales.php'</script>";
