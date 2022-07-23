<?php


include '../../config/koneksi.php';
$id_supplier = strtoupper($_POST['id_supplier']);
$nama_supplier = strtoupper($_POST['nama_supplier']);
$alamat = strtoupper($_POST['alamat']);
$telp = $_POST['telp'];
$email = $_POST['email'];


mysqli_query($conn, "UPDATE supplier SET nama_supplier = '$nama_supplier', alamat_supplier = '$alamat', telp_supplier =  '$telp', email_supplier = '$email' WHERE id_supplier = '$id_supplier'");

echo "<script>location='../m_supplier.php'</script>";
