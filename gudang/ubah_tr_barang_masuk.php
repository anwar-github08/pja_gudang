-<?php
   include '../config/koneksi.php';
   include '../config/validasi.php';
   ?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Barang Masuk</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="../aset/tgl/flatpickr.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <!-- select2 -->

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>
   <?php
   $id = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM transaksi_barang_masuk JOIN supplier ON transaksi_barang_masuk.id_supplier = supplier.id_supplier WHERE transaksi_barang_masuk.id_transaksi_barang_masuk = $id");
   $query2 = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
   ?>
   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Barang Masuk</h4>
            </div>
            <div class="card-body">

               <form action="config/ubah_transaksi_barang_masuk.php" method="post">

                  <?php while ($lihat = mysqli_fetch_assoc($query)) : ?>
                     <label>Tanggal</label>
                     <input type="text" name="tgl" id="tgl" class="form-control mb-3" value="<?= date('d-m-Y', strtotime($lihat['tanggal'])) ?>" placeholder="Tanggal" autocomplete="off" required>

                     <label>Supplier</label>
                     <select name="id_supplier" size="1" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_supplier'] ?>"><?= $lihat['nama_supplier'] ?></option>
                        <?php while ($lihat2 = mysqli_fetch_assoc($query2)) :; ?>
                           <option value="<?= $lihat2['id_supplier'] ?>"><?= $lihat2['nama_supplier'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <input type="hidden" name="waktu" value="<?= date('H:i:s', strtotime($lihat['tanggal'])) ?>">
                     <input type="hidden" name="id_transaksi_barang_masuk" value="<?= $lihat['id_transaksi_barang_masuk'] ?>">

                  <?php endwhile ?>

                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="tampil_barang_masuk.php" type="button" class="btn btn-danger">Batal</a>
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