-<?php
   include '../config/koneksi.php';
   include '../config/validasi.php';
   ?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Barang Keluar</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">
</head>

<body>
   <?php
   $id = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM transaksi_barang_keluar JOIN sales ON transaksi_barang_keluar.id_sales = sales.id_sales JOIN pelanggan ON transaksi_barang_keluar.id_pelanggan = pelanggan.id_pelanggan  WHERE transaksi_barang_keluar.id_transaksi_barang_keluar = $id");
   $querys = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
   $queryp = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Barang Keluar</h4>
            </div>
            <div class="card-body">

               <form action="config/ubah_transaksi_barang_keluar.php" method="post">

                  <?php while ($lihat = mysqli_fetch_assoc($query)) : ?>
                     <label>Tanggal</label>
                     <input type="text" name="tgl" id="tgl" class="form-control mb-3" value="<?= date('d-m-Y', strtotime($lihat['tanggal_keluar'])) ?>" placeholder="Tanggal" autocomplete="off" required>

                     <label>Sales</label>
                     <select name="id_sales" size="1" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_sales'] ?>"><?= $lihat['nama_sales'] ?></option>

                        <?php while ($lihats = mysqli_fetch_assoc($querys)) :; ?>
                           <option value="<?= $lihats['id_sales'] ?>"><?= $lihats['nama_sales'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <label>Pelanggan</label>
                     <select name="id_pelanggan" size="1" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_pelanggan'] ?>"><?= $lihat['nama_pelanggan'] ?></option>

                        <?php while ($lihatp = mysqli_fetch_assoc($queryp)) :; ?>
                           <option value="<?= $lihatp['id_pelanggan'] ?>"><?= $lihatp['nama_pelanggan'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <input type="hidden" name="waktu" value="<?= date('H:i:s', strtotime($lihat['tanggal_keluar'])) ?>">
                     <input type="hidden" name="id_transaksi_barang_keluar" value="<?= $lihat['id_transaksi_barang_keluar'] ?>">
                  <?php endwhile ?>

                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="tampil_barang_keluar.php" type="button" class="btn btn-danger">Batal</a>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>

   <?php include '../a_footer.php'; ?>

   <script src="../aset/select2/dist/js/select2.min.js"></script>
   <script src="../aset/tgl/flatpickr.js"></script>

   <script>
      $(document).ready(function() {
         $('select[size=1]').select2();
      });
      flatpickr("#tgl", {
         dateFormat: 'd-m-Y'
      });
   </script>

</body>

</html>