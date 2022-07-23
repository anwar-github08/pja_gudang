<?php

include '../../config/koneksi.php';
$id_golongan_produk = strtoupper($_POST['id_golongan_produk']);
$nama_golongan_produk = strtoupper($_POST['nama_golongan_produk']);


mysqli_query($conn, "UPDATE golongan_produk SET nama_golongan_produk = '$nama_golongan_produk' WHERE id_golongan_produk = '$id_golongan_produk'");

echo "<script>location='../m_gol_produk.php'</script>";
