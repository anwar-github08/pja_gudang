<!-- ========================================= REPORT ================================================= -->


<!-- untuk barang masuk -->

<!-- menampilkan semua barang masuk dari tanggal 1 sampai 30 Desember 2021 --> tampil tanggal, nama barang, jumlah,  nama supplier -->

<!-- menampilkan semua barang masuk berdasarkan nama supplier PT Saportan --> tampil tanggal, nama barang, jumlah -->

<!-- menampilkan semua barang masuk dari tanggal 1 sampai 30 Desember  dengan nama supplier PT Saportan --> tampil tanggal, nama barang, jumlah -->

<!-- untuk barang kelua -->

<!-- menampilkan semua barang keluar dari tanggal 1 sampai 30 Desember 2021 --> tampil tanggal, nama barang, jumlah,  nama sales, nama pelanggan -->

<!-- menampilkan semua barang keluar berdasarkan pelanggan -> tampil tanggal, nama barang, jumlah, sales -->

<!-- menampilkan semua barang keluar berdasarkan sales -> tampil tanggal, nama barang, jumlah, pelanggan -->

<!-- menampilkan semua barang keluar dari tanggal 1 sampai 30 Desember dengan nama sales Agung --> tanggal, nama barang, jumlah, pelanggan -->

<!-- menampilkan semua barang keluar dari tanggal 1 sampai 30 Desember dengan nama pelanggan Aliansyah --> tanggal, nama barang, jumlah, sales -->

-- menampilkan semua barang keluar dari tanggal 1 sampai 30 Desember dengan nama sales a dan pelanggan Aliansyah tanggal, nama barang, jumlah, sales -->


-- mengubah report menjadi 1 tombol

<!-- =================================================================== -->



-- GUDANG

        <!-- rubah tampilan -->

        <!-- rubah tabel hasil report -->

        <!-- report bulan di kartu stok dihilangkan dulu -->

        -- kartu stok hapus berdasarkan transaksi

        --     ambil id barang berdasarkan id transaksi
        --     set jumlah masuk menjadi 0 dan kasih keterangan dihapus pada kartu_stok

        -- kasih keterangan di tr brang masuk dan keluar
        
        -- returan

            -- buat terlebih dahulu kolom keterangan untuk barang masuk 
            -- buat form retur dengan input nama sales pelanggan barang dan jumlahnya
            -- simpan di tb barang masuk dengan id transaksi 0 dan id supplier 0 dan nama sales dn pelanggan taruh diketerangan pada baragn masuk
            -- tambahkan distok dan kartu stok ( lihat di input barang msuk );

            -- kurang tampil retur
            -- ubah dan hapus retur




        -- nav dikasih retur

        -- select2
        -- hilangkan alert di master

        -- datatables
        -- buat datatables di tampil brang masuk dan keluar beserta detail barang masuk dan keluar dan stok

        -- coba distinc pada supplier laporan barang masuk

        -- kasih tambah kolom dinamis

        -- returan multiinsert spt barang masuk

        -- select 2 pada input barang masuk dan keluar dan returan

        -- tampil semua kartu stok
        -- tampil semua barang keluar
        -- tampil semua barang masuk

        -- dan excel

        -- exceldi masing masing cetak

        -- tambah kolom barang di report masuk dan keluar

        -- tmbah cetak barang masuk tanggal supplier dan barang

        -- tambah cetak barang keluar tanggal sales barang
        -- tambah cetak barang keluar tanggal pelanggan barang

        -- cetak kartu stok

        -- select kartu stok untuk tanggal dan tanggal barang / ambil berdasar distinct kartu stok

        jika jumlah input barang keluar > dari jumlah stok maka tidak bisa
























-- ============================================================================================================================================
cv_pakis

Xampp - 3.2.4
MariaDB - 10.3.15 
php - 7.3.6
html - 5+ 
javascript
Jquery - 3.5 / v1.11.2
bootstrap 4.5.3
Select2 4.1.0-rc.0
fontawesome 4.7
-- ============================================================================================================================================

enter -> tambah item
i -> input item
shift -> simpan data
===================================================================

Kamis, 10/02/2022

tambahan tabel penjualan dan transaksi penjualan
ganti nama kolom tabel pelanggan dan sales

ganti navbar



Sabtu, 12/02/2022

tambah input manual stok
ganti input retur jika barang belum ada distok
report stok pada barang ambil dari barang order asc



Senin, 14/02/2022

tambah kolom ket_piutang pada tabel transaksi_penjualan



Kamis, 17/02/2022

export database dengan nama pakis_gudang_2


Minggu, 20/02/2022

tambah tabel tr_order_pnjualan dan tabel order penjualan 


Senin, 21/02/2022

tambah tabel tmp_order_penjualan
export db dg nama pakis_gudang_3
backup folder cv_pakis di E:\htdoc backup -> input order penjualan dan penjualan


Selasa, 1/03/2022

tambah tabel surat_jalan
export db dg nama pakis_gudang_4
backup folder cv_pakis di E:\htdoc backup -> input order penjualan dan penjualan


Kamis, 3/03/2022

export db nama pakis_gudang_5
backup folder cv_pakis di E:\htdoc backup -> input order penjualan dan penjualan, id sudah diganti semua


Rabu, 9/03/2022

backup folder cv_pakis,,,sudah alert batal dan ada folder fpdf untuk cetak invoice dan surat jalan


Kamis, 21/4/2022

backup folder....sudah semua tinggal..folder sudah rapi..semua input sudah ajax,,tinggal konfirmasi lek harno dan lanjut detail penjualan dan order penjualan


Rabu, 1/6/2022

backup folder dan db....sudah smpai order dan penjualan insert update delete
================================================================================================================================



CATATAN :
jika suplier dihapus,,barang yang ada ikut kehapus nggak
jika sales dihapus,,pelanggan ikut kehapus nggak

jika tidak,,barang dan pelanggan tidak akan muncul,,karena tidak ada relasi

pelanggan berelasi dengan sales nggak,,kalau iya ketika kita pilih sales,,hanya pelanggan dr sales tsb yg dipilih 

tampil barang masuk dan keluar tanggal tidak bisa urut karena mgunakan datatables

hak akses belum valid sepenuhnya..masih bisa  diakses lewat link

default - untuk pelanggan sales dan supplier,,yg berfungsi untuk relasi pada data kartu_stok


untuk input dengan ajax..untuk select2 sya kasih size 1 karena supaya beda dengan select pada tanggal flatpicker

pada datatables sort tanggal harus berformat asli dari mysql

ukuran kertas continous
27.94 cm / 11 inch
24.13 cm / 9.5 inch






-- javascript
kalau value = + itu ada angka 0
kalau value = tidak ada angka 0

console.log itu hanya bisa kebaca dengan nama..kalau tidak ada atrribut nama tidak kebaca

--input data
-- jika tgl tempo kosong,,data diinput ditabase otomatis 0000-00-00,,karena tipe data dlm dtabase date

-- id transaksi penjualan
SP-000000000001 15 karakter
ST-PJ/11-21/0987 16 karakter

-- id transaksi order penjualan
OP-00000001 11 karakter

--id pelanggan
PEL-000001

--id supplier
SUP-000001

--id sales
SAL-000001

--id barang
BRG-000001

--id kel produk
GOL-000001


kertas untuk invoice  21 x 27 cm / 9.5 x 11 inchi

KURANG :
-- Penjualan --
+jika barang sudah diinput select harga belum bisa reset
+format mata uang tanpa mempengaruhi nilai
+alert tanpa refresh halaman
+format mata uang di piutang atas
+simpan semua data ajax
+jika tgl tempo kosong..dan bayar kurang dari piutang ada alert..pmbayaran tidak boleh kurang dari piutang
+ket tgl tempo
+validasi no faktur
+fungsi enter untuk tambah barang
+jika piutang tapi bayarnya lunas
+fokus setelah klik enter
+fixed kontak dan piutang
+jika id kosong,,kasih id otomatis
+tambah field order penjualan dan surat jalan
+selct2 pelanggan otomatis
+tampil nama pelanggan saat onchange select2 pelanggan
+fungsi input penjualan dan manggil dari order kemudian simpan
+tgl pda order proses-?-format tanggal penjualan dan order penjualan => 01-02-2022
+tanggal order penjualan muncul otomatis di penjualan
+import dan ganti id pelanggan, supplier, dan barang
+enter jadi indexing
+kasih fixed tombol untuk keatas halaman
+fungsi batal
+coba cetak surat jalan dan invoice -> kurang kasih nama admin otomatis dan page break.
+validasi hak akses..level akses
+coba ubah master dengan hover popup
+penjualan dan order penjualan pindah folder
+ubah kembali gudang dan master pindah folder dan ubah menjadi ajax
+ubah barang masuk keluar dengan popup
+bagian report....sudah
+sizing cetak surat jalan dan invoice
+detail order dan penjualan
+buat ubah langsung dikolom
+kasih kode surat_jalan otomatis
+cetak redirect print
+tambah form cetak pada edit penjualan

detail barang msuk keluar kasih datatables spy lebih mudah print

sudah bisa print,,tinggal atur ukuran kertas



-- GUDANG PJA

ganti id dan sesuaikan
import data excel master ke database
cek alur transaksi gudang,barang masuk,keluar,kartustok,retur
order by tanggal pada datatables
buat offline aset


-- ============================================================================================================================================



























-- trigger ketika barang keluar dihapus

CREATE TRIGGER `stok_tambah` AFTER DELETE ON `barang_keluar`
 FOR EACH ROW UPDATE stok SET stok.jumlah = stok.jumlah + old.jumlah_keluar WHERE stok.id_barang = old.id_barang

-- trigger ketika barang keluar diubah

 UPDATE kartu_stok SET kartu_stok.jumlah_keluar = new.jumlah_keluar WHERE kartu_stok.id_barang_keluar = new.id_barang_keluar




-- trigger ketika barang masuk dihapus

CREATE TRIGGER `hapus_barang_masuk` AFTER DELETE ON `barang_masuk`
 FOR EACH ROW UPDATE stok SET stok.jumlah = stok.jumlah - old.jumlah WHERE stok.id_barang = old.id_barang

-- trigger ketika barang masuk diubah

 UPDATE kartu_stok SET kartu_stok.jumlah_masuk = new.jumlah WHERE kartu_stok.id_barang_masuk = new.id_barang_masuk


RETURAN : SUMARNO-SAIFUL / JUMAIPAH-CINDO TANI ANUGRAH


fifo,, 

ambil stok barang tanggal paling awal 
jika stok 0 ambil tanggal selanjutnya dibawahnya

jika stok <= jumlah inputan
stok dikurangi jml inputan ( kan jml inputannya masih sisa )

$sisa inputan 



jika sisa stok masih berarti sisan inputan 0
jika masih ada sisa inputan brrti sisa stok 0


fifo kurang diulang selama