<?php
include '../../config/koneksi.php';
include '../../config/validasi.php';
?>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=barang_keluar.xls");
?>



<?php
$id_transaksi_barang_keluar = $_GET['id_transaksi_barang_keluar'];

$query1 = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
$lihat1 = mysqli_fetch_Assoc($query1);

?>

<table cellpadding="10">
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?= date('d M Y / H:i', strtotime($lihat1['tanggal_keluar'])) ?></td>
	</tr>
	<tr>
		<td>Nama Sales</td>
		<td>:</td>
		<td><?= $lihat1['nama_sales'] ?></td>
	</tr>
	<tr>
		<td>Nama Pelanggan</td>
		<td>:</td>
		<td><?= $lihat1['nama_pelanggan'] ?></td>
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
		$query = mysqli_query($conn, "SELECT * FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang WHERE id_transaksi_barang_keluar = $id_transaksi_barang_keluar");
		while ($lihat = mysqli_fetch_Assoc($query)) :;

		?>
			<tr>
				<td><?= $lihat['nama_barang'] ?></td>
				<td align="center"><?= $lihat['jumlah_keluar'] ?></td>
			</tr>
		<?php endwhile ?>
	</tbody>
</table>