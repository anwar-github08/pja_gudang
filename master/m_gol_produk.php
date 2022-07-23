<?php
include '../config/koneksi.php';
include '../config/validasi.php';
?>

<!DOCTYPE html>
<html>

<head>
   <title>Master Kelompok Produk</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="../aset/fontawesome47/css/font-awesome.min.css">

   <!-- untuk datatables -->
   <link rel="stylesheet" href="../aset/datatables/datatables/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="../aset/datatables/button/css/buttons.bootstrap4.min.css">

   <link rel="stylesheet" href="../aset/css/my_style.css">

   <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<body>

   <?php include '../a_navbar.php'; ?>

   <h4>Master Kelompok Produk</h4>
   <hr>
   <a href="master_input_gol_produk.php" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah</a>
   <table id="tabel_barang" class="table table-striped table-bordered table-dark">
      <thead>
         <tr>
            <th>Kode Kelompok Produk</th>
            <th>Nama</th>
            <th>Detail Barang</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $query = mysqli_query($conn, "SELECT * FROM golongan_produk ORDER BY nama_golongan_produk ASC");
         while ($lihat = mysqli_fetch_Assoc($query)) :;

         ?>
            <tr>
               <td><?= $lihat['id_golongan_produk'] ?></td>
               <td><?= $lihat['nama_golongan_produk'] ?></td>
               <td><a href="master_detail_barang_gol_produk.php?id_golongan_produk=<?= $lihat['id_golongan_produk'] ?>" class="btn btn-info btn-sm">Detail Barang</a></td>
               <td><a href="#" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $lihat['id_golongan_produk'] ?>">Ubah</a>
                  <a href="config/master_hapus_gol_produk.php?id_golongan_produk=<?= $lihat['id_golongan_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('hapus data..?')">Hapus</a>
               </td>
            </tr>



            <!-- =========================================== Modal =====================================================-->
            <div class="modal fade" id="modalEdit<?= $lihat['id_golongan_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body">
                        <form action="config/master_ubah_gol_produk.php" method="post">
                           <label>Kode Kelompok Produk</label>
                           <input type="text" name="id_golongan_produk" class="form-control mb-3" value="<?= $lihat['id_golongan_produk'] ?>" readonly>

                           <label>Nama Kelompok Produk</label>
                           <input type="text" name="nama_golongan_produk" class="form-control mb-3" placeholder="Nama Kel Produk" value="<?= $lihat['nama_golongan_produk'] ?>" autocomplete="off" required>

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
   <!-- untuk datatables -->
   <script>
      $(document).ready(function() {
         var table = $('#tabel_barang').DataTable({
            buttons: [{
                  extend: 'print',
                  exportOptions: {
                     columns: [0, 1]
                  }
               },
               {
                  extend: 'excel',
                  exportOptions: {
                     columns: [0, 1]
                  }
               },
               {
                  extend: 'pdf',
                  exportOptions: {
                     columns: [0, 1]
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