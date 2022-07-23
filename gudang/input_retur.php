<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>
<?php date_default_timezone_set('Asia/Jakarta') ?>

<!DOCTYPE html>
<html>

<head>
  <title>Input Retur / Turun Gudang</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
  <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../aset/jquery_alert/css/jquery-alert.css">
  <link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">
  <link rel="stylesheet" href="../aset/css/my_style.css">

  <link rel="icon" type="image/png" href="../gambar/pakis11.png">
</head>

<style type="text/css">
  .card {

    position: sticky;
    top: 60px;
  }
</style>


<body>

  <?php include '../a_navbar.php'; ?>

  <?php
  $querys = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
  $queryp = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
  ?>
  <form method="post" id="form-profil">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
          <strong><i>i</i></strong> - input item &nbsp;&nbsp;<strong><i>Tab</i></strong> - kolom selanjutnya &nbsp;&nbsp;<strong><i>Enter</i></strong> - tambah item &nbsp;&nbsp;<strong><i>Shift</i></strong> - simpan semua data
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-secondary">
          <div class="card-header"></div>
          <div class="card-body">

            <label>Tanggal</label>
            <input type="text" name="tgl" id="tgl" class="form-control mb-2" placeholder="Tanggal" onfocusout="tglfokusout()" autocomplete="off" required>
            <p class="text-danger" id="err_tgl"></p>

            <label>Keterangan</label>
            <select name="keterangan" size="1" id="keterangan" class="form-control mb-2" style="width: 100%" required="">
              <option value="-">-</option>
              <option value="Returan">Returan</option>
              <option value="Turun Gudang">Turun Gudang</option>
            </select>
            <p class="text-danger" id="err_keterangan"></p>

            <div class="sales">
              <label>Sales</label>
              <select name="id_sales" size="1" id="sales" class="form-control mb-2 mt-2" style="width: 100%" required>
                <?php while ($lihats = mysqli_fetch_assoc($querys)) :; ?>
                  <option value="<?= $lihats['id_sales'] ?>&<?= $lihats['nama_sales'] ?>"><?= $lihats['nama_sales'] ?></option>
                <?php endwhile ?>
              </select>
              <p class="text-danger" id="err_sales"></p>
            </div>

            <div class="pelanggan">
              <label>Pelanggan</label>
              <select name="id_pelanggan" size="1" id="pelanggan" class="form-control mb-2" style="width: 100%">
                <?php while ($lihatp = mysqli_fetch_assoc($queryp)) :; ?>
                  <option value="<?= $lihatp['id_pelanggan'] ?>&<?= $lihatp['nama_pelanggan'] ?>"><?= $lihatp['nama_pelanggan'] ?></option>
                <?php endwhile ?>
              </select>
              <p class="text-danger" id="err_pelanggan"></p>
            </div>

            <!-- untuk validasi jml barang -->
            <input type="hidden" id="total_barang">

          </div>

          <div class="card-footer text-muted"></div>
        </div>
      </div>
  </form>




  <div class="col-md-9">
    <div class="card">
      <div class="card-header"></div>
      <div class="card-body">
        <form method="post" id="form-item">
          <table class="table table-bordered">
            <thead>
              <tr align="center">
                <th>Barang</th>
                <th>Jumlah</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr align="center">
                <td>
                  <select name="id_barang" size="1" class="form-control barang mb-3" id="barang">
                    <option value="">-</option>
                    <?php $queryb = mysqli_query($conn, "SELECT DISTINCT barang_masuk.id_barang,barang.nama_barang FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang"); ?>
                    <?php while ($lihatb = mysqli_fetch_assoc($queryb)) :; ?>
                      <option value="<?= $lihatb['id_barang'] ?>"><?= $lihatb['nama_barang'] ?></option>
                    <?php endwhile ?>
                  </select>
                  <p class="text-danger" id="err_barang"></p>
                </td>
                <td>
                  <input type="text" name="jumlah" id="jumlah" onfocusout="jumlahfokusout()" class="form-control" placeholder="Jumlah" autocomplete="off" onkeypress="return hanyaAngka(event)" required>
                  <p class="text-danger" id="err_jumlah"></p>
                </td>

                <td><a class="btn btn-success btn-sm tambah" id="tambah" style="font-size: 80%"><i class="fa fa-plus"></i> Enter</a></td>
              </tr>
            </tbody>
            <!-- untuk simple alert -->
            <p class="text-danger" id="err"></p>
          </table>
        </form>
      </div>
    </div>
    <div class="tampil_item_barang_gudang"></div>
    <a class="btn btn-danger btn-md batal" style="width: 19%">Batal</a>&nbsp;<a class="btn btn-primary btn-md simpan" style="width: 80%"><i class="fa fa-save"></i> Simpan - Shift</a>
    <div class="myalert"></div>
  </div>
  <!-- end col-9 -->

  <?php include '../a_footer.php'; ?>

  <script src="../aset/select2/dist/js/select2.min.js"></script>
  <script src="../aset/jquery_alert/js/jquery-alert.js"></script>
  <script src="../aset/tgl/flatpickr.js"></script>

  <!-- js barang masuk -->
  <script src="js/js_retur.js"></script>

</body>

</html>