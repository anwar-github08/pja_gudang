<?php
include '../../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];

mysqli_query($conn, "UPDATE stok SET jumlah = '$jumlah' WHERE id_barang = '$id_barang' ");

echo "<script>location='../tampil_stok.php'</script>";
