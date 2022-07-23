<!-- =============================================================== navbar atas ==================================================-->

<nav class="navbar navbar-light fixed-top">
    <a class="navbar-brand" href="#">
        <img src="../gambar/pakis1.png" width="30" height="30" class="d-inline-block align-top" alt=""> <b class="text-white">&nbsp; CV. PAKIS JAYA ABADI</b>
    </a>
</nav>

<!--=================================================== navbar vertikal =====================================================-->

<div class="row">

    <?php if ($_SESSION['user']['level'] == 'master') : ?>

        <div class="col-md-2 bg-dark">

            <ul class="nav flex-column ml-3 mr-3 mt-5" style="position: sticky;top: 90px">

                <li class="nav-item">
                    <a class="nav-link text-white" href="../index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../master/m_barang.php">Barang</a>
                        <a class="dropdown-item" href="../master/m_supplier.php">Supplier</a>
                        <a class="dropdown-item" href="../master/m_gol_produk.php">Kelompok Produk</a>
                        <a class="dropdown-item" href="../master/m_sales.php">Sales</a>
                        <a class="dropdown-item" href="../master/m_pelanggan.php">Pelanggan</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <hr><a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-university fa-fw" aria-hidden="true"></i>&nbsp; Gudang</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../gudang/tampil_barang_masuk.php">Barang Masuk</a>
                        <a class="dropdown-item" href="../gudang/tampil_barang_keluar.php">Barang Keluar</a>
                        <a class="dropdown-item" href="../gudang/tampil_retur.php">Retur & Turun Gudang</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <hr><a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp; Transaksi</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../order_penjualan/tampil_order_penjualan.php">Order Penjualan</a>
                        <a class="dropdown-item" href="../penjualan/tampil_penjualan.php">Penjualan</a>
                        <a class="dropdown-item" href="#">Pelunasan Piutang</a>
                    </div>
                </li>

                <li class="nav-item">
                    <hr><a class="nav-link text-white" href="../gudang/tampil_stok.php"><i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; Stok</a>
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../report/report_barang_masuk.php">Laporan Barang Masuk</a>
                        <a class="dropdown-item" href="../report/report_barang_keluar.php">Laporan Barang Keluar</a>
                        <a class="dropdown-item" href="../report/report_kartu_stok.php">Kartu Stok</a>
                    </div>
                </li>

                <li class="nav-item">
                    <hr><a href="../akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; <?= $_SESSION['user']['nama'] ?></a>
                </li>
            </ul>
        </div>

    <?php endif ?>

    <?php if ($_SESSION['user']['level'] == 'admin') : ?>

        <div class="col-md-2 bg-dark">

            <ul class="nav flex-column ml-3 mr-3 mt-5" style="position: sticky;top: 90px">

                <li class="nav-item">
                    <a class="nav-link text-white" href="../index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../master/m_sales.php">Sales</a>
                        <a class="dropdown-item" href="../master/m_pelanggan.php">Pelanggan</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <hr><a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp; Transaksi</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../penjualan/tampil_penjualan.php">Penjualan</a>
                        <a class="dropdown-item" href="#">Pelunasan Piutang</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <hr><a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../report/report_kartu_stok.php">Kartu Stok</a>
                    </div>
                </li>

                <li class="nav-item">
                    <hr><a href="../akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; <?= $_SESSION['user']['nama'] ?></a>
                </li>
            </ul>
        </div>

    <?php endif ?>

    <?php if ($_SESSION['user']['level'] == 'gudang') : ?>

        <div class="col-md-2 bg-dark">

            <ul class="nav flex-column ml-3 mr-3 mt-5" style="position: sticky;top: 90px">

                <li class="nav-item">
                    <a class="nav-link text-white" href="../index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-credit-card-alt fa-fw" aria-hidden="true"></i>&nbsp; Master</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../master/m_barang.php">Barang</a>
                        <a class="dropdown-item" href="../master/m_supplier.php">Supplier</a>
                        <a class="dropdown-item" href="../master/m_gol_produk.php">Kelompok Produk</a>
                        <a class="dropdown-item" href="../master/m_sales.php">Sales</a>
                        <a class="dropdown-item" href="../master/m_pelanggan.php">Pelanggan</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <hr><a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-university fa-fw" aria-hidden="true"></i>&nbsp; Gudang</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../gudang/tampil_barang_masuk.php">Barang Masuk</a>
                        <a class="dropdown-item" href="../gudang/tampil_barang_keluar.php">Barang Keluar</a>
                        <a class="dropdown-item" href="../gudang/tampil_retur.php">Retur & Turun Gudang</a>
                    </div>
                </li>

                <li class="nav-item">
                    <hr><a class="nav-link text-white" href="../gudang/tampil_stok.php"><i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; Stok</a>
                    <hr>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Laporan</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../report/report_barang_masuk.php">Laporan Barang Masuk</a>
                        <a class="dropdown-item" href="../report/report_barang_keluar.php">Laporan Barang Keluar</a>
                        <a class="dropdown-item" href="../report/report_kartu_stok.php">Kartu Stok</a>
                    </div>
                </li>

                <li class="nav-item">
                    <hr><a href="../akses/m_logout.php" class="nav-link text-white" onclick="return confirm('Logout..?')"><i class="fa fa-sign-out fa-fw fa-flip-horizontal" aria-hidden="true"></i>&nbsp; Logout</a>
                </li>
            </ul>
        </div>

    <?php endif ?>

    <!-- konten -->
    <div class="col-md-10 p-5 mt-5">