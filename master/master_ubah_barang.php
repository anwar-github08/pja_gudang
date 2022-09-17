-<?php
   include '../config/koneksi.php';
   include '../config/validasi.php';
   ?>

<!DOCTYPE html>
<html>

<head>
   <title>Ubah Master Barang</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/css/my_style.css">

   <!-- select2 -->
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>
   <?php
   $id_barang = $_GET['id'];
   $query = mysqli_query($conn, "SELECT * FROM barang JOIN golongan_produk ON barang.id_golongan_produk = golongan_produk.id_golongan_produk JOIN supplier ON barang.id_supplier = supplier.id_supplier WHERE barang.id_barang = '$id_barang'");

   $query0 = mysqli_query($conn, "SELECT * FROM golongan_produk");
   $query1 = mysqli_query($conn, "SELECT * FROM supplier");
   ?>

   <div class="row justify-content-center">
      <div class="col-md-4 mt-5">
         <div class="card">
            <div class="card-header">
               <h4>Ubah Master Barang</h4>
            </div>
            <div class="card-body">

               <form action="config/master_ubah_barang.php" method="post">
                  <?php while ($lihat = mysqli_fetch_Assoc($query)) : ?>
                     <label>Golongan Produk</label>
                     <select name="id_golongan_produk" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_golongan_produk'] ?>"><?= $lihat['nama_golongan_produk'] ?></option>
                        <?php while ($lihat0 = mysqli_fetch_assoc($query0)) :; ?>
                           <option value="<?= $lihat0['id_golongan_produk'] ?>"><?= $lihat0['nama_golongan_produk'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <label>Supplier</label>
                     <select name="id_supplier" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['id_supplier'] ?>"><?= $lihat['nama_supplier'] ?></option>
                        <?php while ($lihat1 = mysqli_fetch_assoc($query1)) :; ?>
                           <option value="<?= $lihat1['id_supplier'] ?>"><?= $lihat1['nama_supplier'] ?></option>
                        <?php endwhile ?>
                     </select>

                     <label>Kode Barang</label>
                     <input type="text" name="id_barang" class="form-control mb-3" value="<?= $lihat['id_barang'] ?>" readonly>

                     <label>Nama Barang</label>
                     <input type="text" name="nama_barang" class="form-control mb-3" value="<?= $lihat['nama_barang'] ?>" placeholder="Nama Barang" autocomplete="off" required>

                     <label>Satuan</label>
                     <select name="satuan" class="form-control mb-3" style="width: 100%">
                        <option value="<?= $lihat['satuan'] ?>"><?= $lihat['satuan'] ?></option>
                        <option value="PCS">PCS</option>
                        <option value="BOTOL">BOTOL</option>
                        <option value="ZAK">ZAK</option>
                     </select>
                  <?php endwhile ?>
                  <div class="card-footer text-muted">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                     <a href="m_barang.php" class="btn btn-danger">Batal</a>
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
         $('select').select2();
      });
   </script>

</body>

</html>