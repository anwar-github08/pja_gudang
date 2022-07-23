<?php
include '../../config/koneksi.php';
$id_golongan_produk = $_GET['id_golongan_produk'];

$query = mysqli_query($conn, "DELETE FROM golongan_produk WHERE id_golongan_produk = '$id_golongan_produk'");

echo "<script>location='../m_gol_produk.php'</script>";
