<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Master Pelanggan</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <!-- select2 -->
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

   <!-- untuk tampil gol produk dan supplier -->
   <?php
   $id = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM pelanggan JOIN sales ON pelanggan.id_sales = sales.id_sales WHERE pelanggan.id_pelanggan = '$id' ORDER BY nama_pelanggan ASC");
   $query1 = mysqli_query($conn, "SELECT * FROM sales ORDER BY nama_sales ASC");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Master Pelanggan</h4>
            </div>
            <div class="card-body">

               <form action="config/master_ubah_pelanggan.php" method="post">
                  <?php while ($lihat = mysqli_fetch_assoc($query)) : ?>
                     <label>Sales</label>
                     <select name="id_sales" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_sales'] ?>"><?= $lihat['nama_sales'] ?></option>
                        <?php while ($lihat1 = mysqli_fetch_assoc($query1)) :; ?>
                           <option value="<?= $lihat1['id_sales'] ?>"><?= $lihat1['nama_sales'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <label>Kode Pelanggan</label>
                     <input type="text" name="id_pelanggan" class="form-control mb-3" value="<?= $lihat['id_pelanggan'] ?>" readonly>

                     <label>Nama Pelanggan</label>
                     <input type="text" name="nama_pelanggan" class="form-control mb-3" placeholder="Nama Pelanggan" value="<?= $lihat['nama_pelanggan'] ?>" autocomplete="off" required>

                     <label>Alamat</label>
                     <textarea name="alamat" class="form-control" placeholder="Alamat"><?= $lihat['alamat_pelanggan'] ?></textarea>

                     <label>Telp</label>
                     <input type="text" name="telp" class="form-control mb-3" placeholder="Telp" value="<?= $lihat['telp_pelanggan'] ?>"" onkeypress=" return hanyaAngka(event)" autocomplete="off">
                  <?php endwhile ?>

                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="m_pelanggan.php" class="btn btn-danger">Batal</a>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>

   <?php include '../a_footer.php'; ?>

   <!-- untuk select2 -->
   <script src="../aset/select2/dist/js/select2.min.js"></script>

   <script>
      $(document).ready(function() {
         $('select').select2();
      });
   </script>

   <!-- fungsi javascript hanya angka -->
   <script>
      function hanyaAngka(evt) {

         var kode = (evt.which) ? evt.which : event.keyCode
         if (kode > 31 && (kode < 48 || kode > 57))

            return false;
         return true;
      }
   </script>

</body>

</html>