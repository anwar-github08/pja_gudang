<?php

include '../../config/koneksi.php';
$id_barang = strtoupper($_POST['id_barang']);
$id_golongan_produk = $_POST['id_golongan_produk'];
$id_supplier = $_POST['id_supplier'];
$nama_barang = strtoupper($_POST['nama_barang']);
$satuan = $_POST['satuan'];


mysqli_query($conn, "UPDATE barang SET id_golongan_produk = '$id_golongan_produk', id_supplier =  '$id_supplier', nama_barang = '$nama_barang', satuan = '$satuan' WHERE id_barang = '$id_barang' ");

echo "<script>location='../m_barang.php'</script>";
