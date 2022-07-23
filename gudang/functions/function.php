<?php
$conn = mysqli_connect("localhost", "root", "", "pja_gudang");

function triggerKartuStok($id_barang)
{

   error_reporting(0);
   global $conn;

   $query2 = mysqli_query($conn, "SELECT * FROM kartu_stok WHERE id_barang = '$id_barang'");
   while ($lihat2 = mysqli_fetch_assoc($query2)) {

      $id_kartu_stok = $lihat2['id_kartu_stok']; // lihat id kartu stok
      $id_kartu_stok_atas = $lihat2['id_kartu_stok_atas']; // lihat id kartu stok atas
      $jumlah_masuk = $lihat2['jumlah_masuk'];
      $jumlah_keluar = $lihat2['jumlah_keluar'];

      // ambil sisa dari kolom atas

      $q = mysqli_query($conn, "SELECT sisa FROM kartu_stok WHERE id_kartu_stok = $id_kartu_stok_atas ");
      $l = mysqli_fetch_Assoc($q);

      $sisa_atas = $l['sisa'];

      // hitung sisa yaitu sisa dari kolom atas ditambah jml masuk dri kolom sendiri dan dikurangi jml keluar dri kolom sendiri

      $sisa_fix = $sisa_atas + $jumlah_masuk - $jumlah_keluar;

      // update kartu stok set sisa

      mysqli_query($conn, "UPDATE kartu_stok SET sisa = '$sisa_fix' WHERE id_kartu_stok = $id_kartu_stok");
   }
}
