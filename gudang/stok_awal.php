-<?php
   include '../config/koneksi.php';
   include '../config/validasi.php';
   ?>

<!DOCTYPE html>
<html>

<head>
   <title>Update Stok Manual</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <!-- select2 -->

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

   <?php
   $query = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Update Stok Manual</h4>
            </div>
            <div class="card-body">

               <form action="config/update_stok_manual.php" method="post">

                  <label>Barang</label>
                  <select name="id_barang" size="1" class="form-control mb-5" style="width: 100%">
                     <?php while ($lihat2 = mysqli_fetch_assoc($query)) : ?>
                        <option value="<?= $lihat2['id_barang'] ?>"><?= $lihat2['nama_barang'] ?></option>
                     <?php endwhile ?>
                  </select>

                  <label>Jumlah</label>
                  <input type="text" name="jumlah" class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" placeholder="Jumlah" required>

                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="tampil_stok.php" type="button" class="btn btn-danger">Batal</a>
                  </div>

               </form>

            </div>
         </div>
      </div>
   </div>

   <?php include '../a_footer.php'; ?>

   <script src="../aset/select2/dist/js/select2.min.js"></script>

   <script>
      $(document).ready(function() {
         $('select[size=1]').select2();
      });
   </script>

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