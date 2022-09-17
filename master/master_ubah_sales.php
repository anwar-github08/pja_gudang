<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Master Sales</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

   <?php
   $id = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM sales WHERE id_sales = '$id' ORDER BY nama_sales ASC");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Master Sales</h4>
            </div>
            <div class="card-body">

               <form action="config/master_ubah_sales.php" method="post">
                  <?php while ($lihat = mysqli_fetch_Assoc($query)) :; ?>
                     <label>Kode Sales</label>
                     <input type="text" name="id_sales" class="form-control mb-3" value="<?= $lihat['id_sales'] ?>" readonly>

                     <label>Nama Sales</label>
                     <input type="text" name="nama_sales" class="form-control mb-3" placeholder="Nama Sales" value="<?= $lihat['nama_sales'] ?>" autocomplete="off" required>

                     <label>Alamat</label>
                     <textarea name="alamat" class="form-control" placeholder="Alamat"><?= $lihat['alamat_sales'] ?></textarea>

                     <label>Telp</label>
                     <input type="text" name="telp" class="form-control mb-3" placeholder="Telp" value="<?= $lihat['telp_sales'] ?>" onkeypress="return hanyaAngka(event)" autocomplete="off">
                  <?php endwhile ?>

                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="m_sales.php" class="btn btn-danger">Batal</a>
                  </div>
               </form>

            </div>
         </div>
      </div>

      <?php include '../a_footer.php'; ?>

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