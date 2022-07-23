<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=barang_masuk.xls");
?>


<?php
$id_transaksi_barang_masuk = $_GET['id_transaksi_barang_masuk'];

$query1 = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier ON transaksi_barang_masuk.id_supplier = supplier.id_supplier WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
$lihat1 = mysqli_fetch_Assoc($query1);

?>
<table cellpadding="10">
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?= date('d M Y / H:i', strtotime($lihat1['tanggal'])) ?></td>
	</tr>
	<tr>
		<td>Nama Supplier</td>
		<td>:</td>
		<td><?= $lihat1['nama_supplier'] ?></td>
	</tr>
</table>
<br>
<table border="1" cellpadding="10" width="100%">
	<thead align="center">
		<tr>

			<th>Nama Barang</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_transaksi_barang_masuk = $id_transaksi_barang_masuk");
		while ($lihat = mysqli_fetch_Assoc($query)) :;

		?>
			<tr>
				<td><?= $lihat['nama_barang'] ?></td>
				<td align="center"><?= $lihat['jumlah'] ?></td>
			</tr>
		<?php endwhile ?>
	</tbody>
</table>