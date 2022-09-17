-<?php
   include '../config/koneksi.php';
   include '../config/validasi.php';
   ?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Retur / Turun Gudang</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">


   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>
   <?php
   $id = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang WHERE id_barang_masuk = $id");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Retur / Turun Gudang</h4>
            </div>
            <div class="card-body">

               <form action="config/ubah_retur.php" method="post">
                  <?php while ($lihat = mysqli_fetch_Assoc($query)) : ?>

                     <label>Tanggal :</label>
                     <label><?= date('d M Y', strtotime($lihat['tanggal'])) ?></label>

                     <label style="display: block;"><?= $lihat['keterangan_masuk'] ?></label>

                     <hr>
                     <label style="display: block;">Barang</label>
                     <input type="text" class="form-control" value="<?= $lihat['nama_barang'] ?>" readonly>
                     <label>Jumlah</label>
                     <input type="text" name="jumlah" class="form-control" value="<?= $lihat['jumlah'] ?>" autocomplete="off" onkeypress="return hanyaAngka(event)" placeholder="Jumlah" required>

                     <input type="hidden" name="id_barang_masuk" value="<?= $lihat['id_barang_masuk'] ?>">
                     <input type="hidden" name="id_barang" value="<?= $lihat['id_barang'] ?>">
                     <input type="hidden" name="jumlah_lama" value="<?= $lihat['jumlah'] ?>">

                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="tampil_retur.php" type="button" class="btn btn-danger">Batal</a>
                     </div>
                  <?php endwhile ?>

               </form>

            </div>
         </div>
      </div>
   </div>

   <?php include '../a_footer.php'; ?>

</body>

</html>

<script>
   function hanyaAngka(evt) {

      var kode = (evt.which) ? evt.which : event.keyCode
      if (kode > 31 && (kode < 48 || kode > 57))

         return false;
      return true;
   }
</script>