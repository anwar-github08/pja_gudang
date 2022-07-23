<?php
include 'config/koneksi.php';
session_start();
if (!isset($_SESSION['user'])) {
	echo "<script>location='akses/m_login.php';</script>";
	exit();
};
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="aset/bootstrap-4.5.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="aset/fontawesome47/css/font-awesome.min.css">
	<link rel="stylesheet" href="aset/css/my_style.css">

	<link rel="icon" type="image/png" href="gambar/pakis11.png">

</head>

<style type="text/css">
	body {

		background: url(gambar/cv.jpg) no-repeat fixed;
		background-position: center;
		background-size: 100% 100%;

	}

	.nav-link:hover {

		background-color: burlywood;

	}

	.dropdown-item:hover {

		background-color: burlywood;
	}
</style>

<body>

	<!-- jika level master -->

	<?php if ($_SESSION['user']['level'] == 'master') : ?>


		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">
				<img src="gambar/pakis1.png" width="30" height="30" class="d-inline-block align-top" alt=""> <b class="text-white">&nbsp; CV. PAKIS JAYA ABADI</b>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon text-white"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="master/m_barang.php">Barang</a>
							<a class="dropdown-item" href="master/m_supplier.php">Supplier</a>
							<a class="dropdown-item" href="master/m_gol_produk.php">Kelompok Produk</a>
							<a class="dropdown-item" href="master/m_sales.php">Sales</a>
							<a class="dropdown-item" href="master/m_pelanggan.php">Pelanggan</a>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-university fa-fw" aria-hidden="true"></i>&nbsp; Gudang</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="gudang/tampil_barang_masuk.php">Barang Masuk</a>
							<a class="dropdown-item" href="gudang/tampil_barang_keluar.php">Barang Keluar</a>
							<a class="dropdown-item" href="gudang/tampil_retur.php">Retur & Turun Gudang</a>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp; Transaksi</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="order_penjualan/tampil_order_penjualan.php">Order Penjualan</a>
							<a class="dropdown-item" href="penjualan/tampil_penjualan.php">Penjualan</a>
							<a class="dropdown-item" href="#">Pelunasan Piutang</a>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link text-white" href="gudang/tampil_stok.php"><i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; Stok</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="report/report_barang_masuk.php">Laporan Barang Masuk</a>
							<a class="dropdown-item" href="report/report_barang_keluar.php">Laporan Barang Keluar</a>
							<a class="dropdown-item" href="report/report_kartu_stok.php">Kartu Stok</a>
						</div>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<a href="akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; <?= $_SESSION['user']['nama'] ?></a>
				</form>
			</div>
		</nav>

	<?php endif ?>

	<!-- jika user admin -->

	<?php if ($_SESSION['user']['level'] == 'admin') : ?>

		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">
				<img src="gambar/pakis1.png" width="30" height="30" class="d-inline-block align-top" alt=""> <b class="text-white">&nbsp; CV. PAKIS JAYA ABADI</b>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon text-white"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="master/m_sales.php">Sales</a>
							<a class="dropdown-item" href="master/m_pelanggan.php">Pelanggan</a>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp; Transaksi</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="penjualan/tampil_penjualan.php">Penjualan</a>
							<a class="dropdown-item" href="#">Pelunasan Piutang</a>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="report/report_kartu_stok.php">Kartu Stok</a>
						</div>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<a href="akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; <?= $_SESSION['user']['nama'] ?></a>
				</form>
			</div>
		</nav>

	<?php endif ?>

	<?php if ($_SESSION['user']['level'] == 'gudang') : ?>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">
				<img src="gambar/pakis1.png" width="30" height="30" class="d-inline-block align-top" alt=""> <b class="text-white">&nbsp; CV. PAKIS JAYA ABADI</b>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon text-white"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="master/m_barang.php">Barang</a>
							<a class="dropdown-item" href="master/m_supplier.php">Supplier</a>
							<a class="dropdown-item" href="master/m_gol_produk.php">Kelompok Produk</a>
							<a class="dropdown-item" href="master/m_sales.php">Sales</a>
							<a class="dropdown-item" href="master/m_pelanggan.php">Pelanggan</a>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-university fa-fw" aria-hidden="true"></i>&nbsp; Gudang</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="gudang/tampil_barang_masuk.php">Barang Masuk</a>
							<a class="dropdown-item" href="gudang/tampil_barang_keluar.php">Barang Keluar</a>
							<a class="dropdown-item" href="gudang/tampil_retur.php">Retur & Turun Gudang</a>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link text-white" href="gudang/tampil_stok.php"><i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; Stok</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="report/report_barang_masuk.php">Laporan Barang Masuk</a>
							<a class="dropdown-item" href="report/report_barang_keluar.php">Laporan Barang Keluar</a>
							<a class="dropdown-item" href="report/report_kartu_stok.php">Kartu Stok</a>
						</div>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<a href="akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; <?= $_SESSION['user']['nama'] ?></a>
				</form>
			</div>
		</nav>
	<?php endif ?>

	<!-- jquery -->
	<script src="aset/jquery-3.5.1/jquery-3.5.1.js"></script>
	<!-- bootstrap js-->
	<script src="aset/bootstrap-4.5.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>