<?php include '../../config/koneksi.php'; ?>

<table class="table table-bordered table-striped mt-2">
  <thead>
    <tr align="center">
      <th width="4%">No</th>
      <th>Barang</th>
      <th>Jumlah</th>
      <th>-</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $a = 1;
    $query = mysqli_query($conn, "SELECT * FROM tmp_barang_gudang JOIN barang ON barang.id_barang = tmp_barang_gudang.tmp_id_barang");
    while ($lihat = mysqli_fetch_assoc($query)) :;
    ?>
      <tr align="center">
        <td><?= $a++ ?></td>
        <td><?= $lihat['nama_barang'] ?></td>
        <td><?= $lihat['tmp_jumlah'] ?></td>
        <td><a class="btn btn-danger btn-sm hapus_data" id="<?= $lihat['id_tmp_barang_gudang'] ?>"><i class="fa fa-trash"></i></a></td>
      </tr>
    <?php endwhile ?>
  </tbody>
</table>

<input type="hidden" id="total_barang_tmp" value="<?= $a ?>">



<!-- =============================================================================================== -->
<script type="text/javascript">
  $(document).ready(function() {

    var total_barang = document.getElementById('total_barang_tmp').value;

    document.getElementById('total_barang').value = total_barang;
    $(".hapus_data").click(function() {
      var id = $(this).attr('id');
      $.ajax({
        type: 'POST',
        url: "config/tmp_hapus_item_barang_gudang.php",
        data: 'id=' + id,
        success: function() {
          $('.tampil_item_barang_gudang').load("config/tmp_tampil_item_barang_gudang.php");
        }
      });
    });

  });
</script>
<!-- =============================================================================================== -->