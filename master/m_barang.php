<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <title>Master Barang</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">
   <link rel="stylesheet" href="../aset/select2/dist/css/select2.min.css">

   <!-- untuk datatables -->
   <link rel="stylesheet" href="../aset/datatables/datatables/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="../aset/datatables/button/css/buttons.bootstrap4.min.css">

   <link rel="stylesheet" href="../aset/css/my_style.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

   <?php include '../a_navbar.php'; ?>

   <h4>Master Barang</h4>
   <hr>
   <a href="master_input_barang.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
   <table id="tabel_barang" class="table table-striped table-bordered table-dark">
      <thead>
         <tr>
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Gol Produk</th>
            <th>Supplier</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $query = mysqli_query($conn, "SELECT * FROM barang JOIN golongan_produk ON barang.id_golongan_produk = golongan_produk.id_golongan_produk JOIN supplier ON barang.id_supplier = supplier.id_supplier");
         while ($lihat = mysqli_fetch_Assoc($query)) :;

         ?>
            <tr>
               <td><?= $lihat['id_barang'] ?></td>
               <td><?= $lihat['nama_barang'] ?></td>
               <td><?= $lihat['satuan'] ?></td>
               <td><?= $lihat['nama_golongan_produk'] ?></td>
               <td><?= $lihat['nama_supplier'] ?></td>
               <td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_barang'] ?>">Ubah</a> <a href="config/master_hapus_barang.php?id_barang=<?= $lihat['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a></td>
            </tr>

            <!-- =========================================== Modal =====================================================-->
            <div class="modal fade" id="modalEdit<?= $lihat['id_barang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body">
                        <form action="config/master_ubah_barang.php" method="post">

                           <!-- untuk tampil gol produk dan supplier -->
                           <?php
                           $query0 = mysqli_query($conn, "SELECT * FROM golongan_produk");
                           $query1 = mysqli_query($conn, "SELECT * FROM supplier");
                           ?>

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

                           <div class="modal-footer">
                              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- =========================================== END Modal =======================================================-->

         <?php endwhile ?>
      </tbody>
   </table>

   <?php include '../a_footer.php'; ?>

   <script src="../aset/select2/dist/js/select2.min.js"></script>

   <!-- untuk datatables -->
   <script src="../aset/datatables/datatables/js/jquery.dataTables.min.js"></script>
   <script src="../aset/datatables/datatables/js/dataTables.bootstrap4.min.js"></script>

   <script src="../aset/datatables/button/js/dataTables.buttons.min.js"></script>
   <script src="../aset/datatables/button/js/buttons.bootstrap4.min.js"></script>

   <script src="../aset/datatables/jszip/jszip.min.js"></script>

   <script src="../aset/datatables/pdfmake/pdfmake.js"></script>
   <script src="../aset/datatables/pdfmake/vfs_fonts.js"></script>

   <script src="../aset/datatables/button/js/buttons.html5.min.js"></script>
   <script src="../aset/datatables/button/js/buttons.print.min.js"></script>
   <script src="../aset/datatables/button/js/buttons.colVis.min.js"></script>

   <!-- select2 -->
   <script>
      $(document).ready(function() {
         $('select').select2();
      });
   </script>

   <!-- untuk datatables -->
   <script>
      $(document).ready(function() {
         var table = $('#tabel_barang').DataTable({
            buttons: [{
                  extend: 'print',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4]
                  }
               },
               {
                  extend: 'excel',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4]
                  }
               },
               {
                  extend: 'pdf',
                  exportOptions: {
                     columns: [0, 1, 2, 3, 4]
                  }
               },
            ]
         });

         table.buttons().container()
            .appendTo('#tabel_barang_wrapper .col-md-6:eq(0)');
      });
   </script>

</body>

</html>