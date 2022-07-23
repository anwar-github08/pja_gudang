<?php include '../../config/koneksi.php';

$id_tmp_barang_gudang = $_POST['id'];

mysqli_query($conn, "DELETE FROM tmp_barang_gudang WHERE id_tmp_barang_gudang = $id_tmp_barang_gudang");
mysqli_query($conn, "ALTER TABLE tmp_barang_gudang AUTO_INCREMENT=1");
