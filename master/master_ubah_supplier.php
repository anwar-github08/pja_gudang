<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Master Supplier</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>
   <?php
   $id_supplier = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM supplier WHERE id_supplier = '$id_supplier' ORDER BY nama_supplier ASC");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Master Supplier</h4>
            </div>
            <div class="card-body">

               <form action="config/master_ubah_supplier.php" method="post">
                  <?php while ($lihat = mysqli_fetch_Assoc($query)) : ?>
                     <label>Kode Supplier</label>
                     <input type="text" name="id_supplier" class="form-control mb-3" value="<?= $lihat['id_supplier'] ?>" readonly>

                     <label>Nama Supplier</label>
                     <input type="text" name="nama_supplier" class="form-control mb-3" value="<?= $lihat['nama_supplier'] ?>" placeholder="Nama Supplier" autocomplete="off" required>

                     <label>Alamat</label>
                     <textarea name="alamat" class="form-control" placeholder="Alamat"><?= $lihat['alamat_supplier'] ?></textarea>

                     <label>Telp</label>
                     <input type="text" name="telp" class="form-control mb-3" placeholder="Telp" value="<?= $lihat['telp_supplier'] ?>" onkeypress="return hanyaAngka(event)" autocomplete="off">

                     <label>Email</label>
                     <input type="text" name="email" class="form-control mb-3" placeholder="Email" value="<?= $lihat['email_supplier'] ?>" autocomplete="off">
                  <?php endwhile ?>

                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="m_supplier.php" class="btn btn-danger">Batal</a>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>

   <?php include '../a_footer.php'; ?>

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