// ! penjualan ->

<script type="text/javascript">
    $(document).ready(function() {
        $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");

        $(".tambah").click(function() {
            tambahItem();
        });

        $(".simpan").click(function() {
            simpanSemuaData();
        });

        $(".batal").click(function() {
            batal();
        });

        // $("#card_po").hide();


        window.addEventListener("keydown", (code) => {
            // if (code.key == 'Enter') {
            //   tambahItem();
            // }
            if (code.key == 'Shift') {
                simpanSemuaData();
            }
            if (code.key == 'i') {
                $("#barang").select2('open');
            }
        })

        $('input').on('keypress', function(e) {
            if (e.which == 13) {
                switch ($(this).attr('id')) {
                    case 'barang':
                        $('#jumlah').focus();
                        e.preventDefault();
                        break;
                    case 'jumlah':
                        $('#harga').focus();
                        e.preventDefault();
                        break;
                    case 'harga':
                        $('#tambah').click();
                        e.preventDefault();
                        break;
                }
            }
        });
    });
</script>

<!-- fungsi uppercase pada id -->
<script>
    function uppercase() {

        var x = document.getElementById('id_transaksi_penjualan');
        var y = document.getElementById('no_surat_jalan');
        x.value = x.value.toUpperCase();
        y.value = y.value.toUpperCase();
    }
</script>

<!-- fungsi cek id -->
<script>
    function cekid() {
        $(document).ready(function() {
            var id_transaksi_penjualan = $('#id_transaksi_penjualan').val();
            $.ajax({
                type: 'POST',
                url: "config/cek_validasi_id_transaksi_penjualan.php",
                data: 'id=' + id_transaksi_penjualan,
                success: function(response) {

                    if (response == 'ada') {
                        document.getElementById('id_transaksi_penjualan').focus();
                        $('.myalert').simpleAlert({
                            message: 'No faktur sudah digunakan..!!'
                        });
                    }
                }
            });
        })
    }
</script>

<script>
    function tglfokusout() {
        document.getElementById('err_tgl').innerHTML = "";
    }

    function jumlahfokusout() {
        document.getElementById('err_jumlah').innerHTML = "";
    }

    function hargafokusout() {
        document.getElementById('err_harga').innerHTML = "";
    }
</script>

<!-- fyngsi tambah item -->
<script type="text/javascript">
    function tambahItem() {
        var data = $('#form-item').serialize();
        var barang = $('#barang').val();
        var jumlah = $('#jumlah').val();
        var harga = $('#harga').val();


        if (jumlah == '') {
            document.getElementById("err_jumlah").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_jumlah").innerHTML = "";
        }
        if (harga == '') {

            document.getElementById("err_harga").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_harga").innerHTML = "";
        }
        if (barang == '') {

            document.getElementById("err_barang").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_barang").innerHTML = "";
        }

        if (harga != '' && jumlah != '' && barang != '') {
            $.ajax({
                type: 'POST',
                url: "config/tmp_simpan_item_penjualan.php",
                data: data,
                success: function() {
                    $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");
                    document.getElementById("form-item").reset();
                    $("#barang").select2({
                        placeholder: "-",
                        initSelection: function(element, callback) {}
                    });

                    $("#barang").select2('open');
                }
            });
        }
    }
</script>

<!-- fungsi simpan semua data -->
<script type="text/javascript">
    function simpanSemuaData() {
        var data2 = $('#form-profil').serialize();
        var tgl = $('#tgl').val();
        var tgl_tempo = $('#tgl_tempo').val();
        var sales = $('#sales').val();
        var pelanggan = $('#pelanggan').val();
        var lokasi = $('#lokasi').val();
        var gtotal = $('#txt_gtotal').val();
        var bayar = $('#txt_bayar').val();
        var piutang = $('#txt_piutang').val();

        var cetak = $('#cetak').val();

        document.getElementById('err_tgl').innerHTML = "";
        document.getElementById('err_sales').innerHTML = "";
        document.getElementById('err_pelanggan').innerHTML = "";

        if (tgl == '') {
            document.getElementById('err_tgl').innerHTML = "Wajib diisi..!!";
        } else if (sales == '') {
            document.getElementById('err_sales').innerHTML = "Wajib diisi..!!";
        } else if (pelanggan == '') {
            document.getElementById('err_pelanggan').innerHTML = "Wajib diisi..!!";
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal == '0') {
            $('.myalert').simpleAlert({
                message: 'Item kosong..!!'
            })
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal != '0' && tgl_tempo == '' && bayar == '0') {
            $('.myalert').simpleAlert({
                message: 'Transaksi tunai, lakukan pembayaran..!!'
            })
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal != '0' && tgl_tempo == '' && piutang != '0') {
            $('.myalert').simpleAlert({
                message: 'Pembayaran tidak boleh kurang dari piutang..!!'
            })
        } else {

            $.ajax({
                type: 'POST',
                url: "config/simpan_penjualan.php",
                data: data2,
                success: function(response) {
                    var id_transaksi_penjualan = response.trimStart();

                    if (cetak == 'tidak_dicetak') {
                        location = 'tampil_penjualan.php';
                    }
                    if (cetak == 'invoice') {
                        location = '../cetak/cetak_penjualan.php?cetak=invoice&id_transaksi_penjualan=' + id_transaksi_penjualan;

                    }
                    if (cetak == 'surat_jalan') {
                        location = '../cetak/cetak_penjualan.php?cetak=surat_jalan&id_transaksi_penjualan=' + id_transaksi_penjualan;
                    }
                    if (cetak == 'invoice_surat_jalan') {
                        location = '../cetak/cetak_penjualan.php?cetak=invoice_surat_jalan&id_transaksi_penjualan=' + id_transaksi_penjualan;
                    }
                }
            });
            // console.log(data2)
        }
    }
</script>

<!-- fungsi panggil order penjualan -->
<script type="text/javascript">
    function panggilOrderPenjualan() {
        var id = document.getElementById("id_transaksi_order_penjualan").value;
        var pel = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "config/panggil_order_penjualan.php",
            data: 'id=' + id,
            success: function(response) {
                $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");

                // potong string berdasar tanda '?'
                var hasil = response.split("?");
                var idsal = hasil[0];
                var idpel = hasil[1];
                var alamatpel = hasil[2];
                var tglorder = hasil[3];
                var kode_sj = hasil[4];
                var tgl_tempo = hasil[5];
                var tgl_pengiriman = hasil[6];

                // fungsi menghapus karakter atau enter dari hasil
                var id_sal = idsal.trimStart();
                var id_pel = idpel.trimStart();

                // console.log(tglorder); tampilkan tgl order di tanggal
                document.getElementById("tgl").value = tglorder;

                // tampilkan tgl_tempo
                $("#tgl_tempo").val(tgl_tempo);

                // change select2 sales
                $("#sales").select2().val(id_sal);
                $("#sales").select2().trigger("change");

                // change select2 pelanggan
                $("#pelanggan").select2().val(id_pel);
                $("#pelanggan").select2().trigger("change");

                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = alamatpel;

                // tampilkan no_surat_jalan otomatis
                $("#no_surat_jalan").val(kode_sj);

                // tampilkan tgl_pengiriman
                $("#tgl_pengiriman").val(tgl_pengiriman);

                // console.log(response);

            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi panggil alamat pelanggan-->
<script type="text/javascript">
    function panggilPelanggan() {
        var id = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "config/panggil_pelanggan.php",
            data: 'id=' + id,
            success: function(response) {

                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = response;
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi batal -->
<script type="text/javascript">
    function batal() {
        $(".myalert").simpleConfirm({
            title: "Batal..?",
            // message: "Batal..?",
            acceptBtnLabel: 'Ok',
            success: function() {
                $.ajax({
                    type: 'POST',
                    url: "config/batal.php",
                    success: function() {
                        location = 'tampil_penjualan.php';
                    }
                });
            }
        })

    }
</script>


<!-- fungsi focus ke jumlah setelah select2 close -->
<script>
    $('#barang').on('select2:close', function() {
        $('#jumlah').focus();
    });
</script>

<!-- fungsi show_hide po -->
<!-- <script type="text/javascript">
  var a;
  function show_hide_po(){
    if(a==1)
    {
        document.getElementById("card_po").style.display="block";
        return a=0;
    }

    else
    {
        document.getElementById("card_po").style.display="none";
        return a=1;
    }
  }
</script>
 -->



<!-- =============================================================================================== -->
<script>
    $(document).ready(function() {
        $("select[size=1]").select2();
    });
</script>
<script>
    config = {
        minDate: "today",
        dateFormat: "d-m-Y",
    }
    flatpickr("#tgl", {
        dateFormat: "d-m-Y"
    });
    flatpickr("#tgl_pengiriman", config);
    flatpickr("#tgl_tempo", config);
</script>
<script>
    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function hanyaAngka(evt) {
        var kode = (evt.which) ? evt.which : event.keyCode
        if (kode > 31 && (kode < 48 || kode > 57))
            return false;
        return true;
    }
</script>
<!-- =============================================================================================== -->



// ! untuk detail penjualan -->
<!-- =============================================================================================== -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");

        $(".tambah").click(function() {
            tambahItem();
        });

        $(".simpan").click(function() {
            simpanSemuaData();
        });

        $(".batal").click(function() {
            batal();
        });

        // $("#card_po").hide();


        window.addEventListener("keydown", (code) => {
            // if (code.key == 'Enter') {
            //   tambahItem();
            // }
            if (code.key == 'Shift') {
                simpanSemuaData();
            }
            if (code.key == 'i') {
                $("#barang").select2('open');
            }
        })

        $('input').on('keypress', function(e) {
            if (e.which == 13) {
                switch ($(this).attr('id')) {
                    case 'barang':
                        $('#jumlah').focus();
                        e.preventDefault();
                        break;
                    case 'jumlah':
                        $('#harga').focus();
                        e.preventDefault();
                        break;
                    case 'harga':
                        $('#tambah').click();
                        e.preventDefault();
                        break;
                }
            }
        });
    });
</script>

<!-- fungsi uppercase pada id -->
<script>
    function uppercase() {

        var x = document.getElementById('id_transaksi_penjualan');
        var y = document.getElementById('no_surat_jalan');
        x.value = x.value.toUpperCase();
        y.value = y.value.toUpperCase();
    }
</script>

<!-- fungsi cek id -->
<script>
    function cekid() {
        $(document).ready(function() {
            var id_transaksi_penjualan = $('#id_transaksi_penjualan').val();
            $.ajax({
                type: 'POST',
                url: "config/cek_validasi_id_transaksi_penjualan.php",
                data: 'id=' + id_transaksi_penjualan,
                success: function(response) {

                    if (response == 'ada') {
                        document.getElementById('id_transaksi_penjualan').focus();
                        $('.myalert').simpleAlert({
                            message: 'No faktur sudah digunakan..!!'
                        });
                    }
                }
            });
        })
    }
</script>

<script>
    function tglfokusout() {
        document.getElementById('err_tgl').innerHTML = "";
    }

    function jumlahfokusout() {
        document.getElementById('err_jumlah').innerHTML = "";
    }

    function hargafokusout() {
        document.getElementById('err_harga').innerHTML = "";
    }
</script>

<!-- fyngsi tambah item -->
<script type="text/javascript">
    function tambahItem() {
        var data = $('#form-item').serialize();
        var barang = $('#barang').val();
        var jumlah = $('#jumlah').val();
        var harga = $('#harga').val();


        if (jumlah == '') {
            document.getElementById("err_jumlah").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_jumlah").innerHTML = "";
        }
        if (harga == '') {

            document.getElementById("err_harga").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_harga").innerHTML = "";
        }
        if (barang == '') {

            document.getElementById("err_barang").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_barang").innerHTML = "";
        }

        if (harga != '' && jumlah != '' && barang != '') {
            $.ajax({
                type: 'POST',
                url: "config/tmp_simpan_item_penjualan.php",
                data: data,
                success: function() {
                    $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");
                    document.getElementById("form-item").reset();
                    $("#barang").select2({
                        placeholder: "-",
                        initSelection: function(element, callback) {}
                    });

                    $("#barang").select2('open');
                }
            });
        }
    }
</script>

<!-- fungsi simpan semua data -->
<script type="text/javascript">
    function simpanSemuaData() {
        var data2 = $('#form-profil').serialize();
        var id_transaksi_penjualan = $('#id_transaksi_penjualan').val();
        var tgl = $('#tgl').val();
        var tgl_tempo = $('#tgl_tempo').val();
        var sales = $('#sales').val();
        var pelanggan = $('#pelanggan').val();
        var lokasi = $('#lokasi').val();
        var gtotal = $('#txt_gtotal').val();
        var bayar = $('#txt_bayar').val();
        var piutang = $('#txt_piutang').val();

        var cetak = $('#cetak').val();

        document.getElementById('err_tgl').innerHTML = "";
        document.getElementById('err_sales').innerHTML = "";
        document.getElementById('err_pelanggan').innerHTML = "";

        if (tgl == '') {
            document.getElementById('err_tgl').innerHTML = "Wajib diisi..!!";
        } else if (id_transaksi_penjualan == '') {
            document.getElementById('err_id_transaksi_penjualan').innerHTML = "Wajib diisi..!!";
        } else if (sales == '') {
            document.getElementById('err_sales').innerHTML = "Wajib diisi..!!";
        } else if (pelanggan == '') {
            document.getElementById('err_pelanggan').innerHTML = "Wajib diisi..!!";
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal == '0') {
            $('.myalert').simpleAlert({
                message: 'Item kosong..!!'
            })
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal != '0' && tgl_tempo == '' && bayar == '0') {
            $('.myalert').simpleAlert({
                message: 'Transaksi tunai, lakukan pembayaran..!!'
            })
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal != '0' && tgl_tempo == '' && piutang != '0') {
            $('.myalert').simpleAlert({
                message: 'Pembayaran tidak boleh kurang dari piutang..!!'
            })
        } else {

            $.ajax({
                type: 'POST',
                url: "config/simpan_detail_penjualan.php",
                data: data2,
                success: function() {
                    if (cetak == 'tidak_dicetak') {
                        location = 'tampil_penjualan.php';
                    }
                    if (cetak == 'invoice') {
                        location = '../cetak/cetak_penjualan.php?cetak=invoice&id_transaksi_penjualan=' + id_transaksi_penjualan;

                    }
                    if (cetak == 'surat_jalan') {
                        location = '../cetak/cetak_penjualan.php?cetak=surat_jalan&id_transaksi_penjualan=' + id_transaksi_penjualan;
                    }
                    if (cetak == 'invoice_surat_jalan') {
                        location = '../cetak/cetak_penjualan.php?cetak=invoice_surat_jalan&id_transaksi_penjualan=' + id_transaksi_penjualan;
                    }
                }
            });

            // console.log(cetak);
        }
    }
</script>

<!-- fungsi panggil order penjualan -->
<script type="text/javascript">
    function panggilOrderPenjualan() {
        var id = document.getElementById("id_transaksi_order_penjualan").value;
        var pel = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "config/panggil_order_penjualan.php",
            data: 'id=' + id,
            success: function(response) {
                $('.tampil_item_penjualan').load("config/tmp_tampil_item_penjualan.php");

                // potong string berdasar tanda '?'
                var hasil = response.split("?");
                var idsal = hasil[0];
                var idpel = hasil[1];
                var alamatpel = hasil[2];
                var tglorder = hasil[3];

                // fungsi menghapus karakter atau enter dari hasil
                var id_sal = idsal.trimStart();
                var id_pel = idpel.trimStart();

                // console.log(tglorder); tampilkan tgl order di tanggal
                document.getElementById("tgl").value = tglorder;

                // change select2 sales
                $("#sales").select2().val(id_sal);
                $("#sales").select2().trigger("change");

                // change select2 pelanggan
                $("#pelanggan").select2().val(id_pel);
                $("#pelanggan").select2().trigger("change");

                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = alamatpel

            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi panggil alamat pelanggan-->
<script type="text/javascript">
    function panggilPelanggan() {
        var id = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "config/panggil_pelanggan.php",
            data: 'id=' + id,
            success: function(response) {

                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = response;
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi batal -->
<script type="text/javascript">
    function batal() {
        $(".myalert").simpleConfirm({
            title: "Batal..?",
            // message: "Batal..?",
            acceptBtnLabel: 'Ok',
            success: function() {
                $.ajax({
                    type: 'POST',
                    url: "config/batal.php",
                    success: function() {
                        location = 'tampil_penjualan.php';
                    }
                });
            }
        })

    }
</script>


<!-- fungsi focus ke jumlah setelah select2 close -->
<script>
    $('#barang').on('select2:close', function() {
        $('#jumlah').focus();
    });
</script>

<!-- fungsi show_hide po -->
<!-- <script type="text/javascript">
  var a;
  function show_hide_po(){
    if(a==1)
    {
        document.getElementById("card_po").style.display="block";
        return a=0;
    }

    else
    {
        document.getElementById("card_po").style.display="none";
        return a=1;
    }
  }
</script>
 -->



<!-- =============================================================================================== -->
<script>
    $(document).ready(function() {
        $("select[size=1]").select2();
    });
</script>
<script>
    config = {
        dateFormat: "d-m-Y"
    }
    flatpickr("#tgl", config);
    flatpickr("#tgl_pengiriman", config);
    flatpickr("#tgl_tempo", config);
</script>
<script>
    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function hanyaAngka(evt) {
        var kode = (evt.which) ? evt.which : event.keyCode
        if (kode > 31 && (kode < 48 || kode > 57))
            return false;
        return true;
    }
</script>
<!-- =============================================================================================== -->



// ! order penjualan
<!-- =============================================================================================== -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.tampil_item_order_penjualan').load("config/tmp_tampil_item_order_penjualan.php");

        $(".tambah").click(function() {
            tambahItem();
        });

        $(".simpan").click(function() {
            simpanSemuaData();
        });

        $(".batal").click(function() {
            batal();
        });


        window.addEventListener("keydown", (code) => {
            // if (code.key == 'Enter') {
            //   tambahItem();
            // }
            if (code.key == 'Shift') {
                simpanSemuaData();
            }
            if (code.key == 'i') {
                $("#barang").select2('open');
            }
        })


        $('input').on('keypress', function(e) {
            if (e.which == 13) {
                switch ($(this).attr('id')) {
                    case 'barang':
                        $('#jumlah').focus();
                        e.preventDefault();
                        break;
                    case 'jumlah':
                        $('#harga').focus();
                        e.preventDefault();
                        break;
                    case 'harga':
                        $('#tambah').click();
                        e.preventDefault();
                        break;
                }
            }
        });
    });
</script>

<!-- fungsi uppercase pada id -->
<script>
    function uppercase() {

        var x = document.getElementById('id_transaksi_order_penjualan');
        x.value = x.value.toUpperCase();
    }
</script>


<!-- fungsi cek id -->
<script>
    function cekid() {
        $(document).ready(function() {
            var id_transaksi_order_penjualan = $('#id_transaksi_order_penjualan').val();
            $.ajax({
                type: 'POST',
                url: "config/cek_validasi_id_transaksi_order_penjualan.php",
                data: 'id=' + id_transaksi_order_penjualan,
                success: function(response) {

                    if (response == 'ada') {
                        document.getElementById('id_transaksi_order_penjualan').focus();
                        $('.myalert').simpleAlert({
                            message: 'No faktur sudah digunakan..!!'
                        });
                    }
                }
            });
        })
    }
</script>

<script>
    function tglfokusout() {
        document.getElementById('err_tgl').innerHTML = "";
    }

    function jumlahfokusout() {
        document.getElementById('err_jumlah').innerHTML = "";
    }

    function hargafokusout() {
        document.getElementById('err_harga').innerHTML = "";
    }
</script>

<!-- fyngsi tambah item -->
<script type="text/javascript">
    function tambahItem() {
        var data = $('#form-item').serialize();
        var barang = $('#barang').val();
        var jumlah = $('#jumlah').val();
        var harga = $('#harga').val();


        if (jumlah == '') {
            document.getElementById("err_jumlah").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_jumlah").innerHTML = "";
        }
        if (harga == '') {

            document.getElementById("err_harga").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_harga").innerHTML = "";
        }
        if (barang == '') {

            document.getElementById("err_barang").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_barang").innerHTML = "";
        }

        if (harga != '' && jumlah != '' && barang != '') {
            $.ajax({
                type: 'POST',
                url: "config/tmp_simpan_item_order_penjualan.php",
                data: data,
                success: function() {
                    $('.tampil_item_order_penjualan').load("config/tmp_tampil_item_order_penjualan.php");
                    document.getElementById("form-item").reset();
                    $("#barang").select2({
                        placeholder: "-",
                        initSelection: function(element, callback) {}
                    });

                    $("#barang").select2('open');
                }
            });
        }
    }
</script>

<!-- fungsi simpan semua data -->
<script type="text/javascript">
    function simpanSemuaData() {
        var data2 = $('#form-profil').serialize();
        var id_transaksi_order_penjualan = $('#id_transaksi_order_penjualan').val();
        var tgl = $('#tgl').val();
        var sales = $('#sales').val();
        var pelanggan = $('#pelanggan').val();

        var gtotal = $('#txt_gtotal').val();

        document.getElementById('err_tgl').innerHTML = "";
        document.getElementById('err_sales').innerHTML = "";
        document.getElementById('err_pelanggan').innerHTML = "";

        if (id_transaksi_order_penjualan == '') {
            document.getElementById('err_id_transaksi_order_penjualan').innerHTML = "Wajib diisi..!!";
        } else if (tgl == '') {
            document.getElementById('err_tgl').innerHTML = "Wajib diisi..!!";
        } else if (pelanggan == '') {
            document.getElementById('err_pelanggan').innerHTML = "Wajib diisi..!!";
        } else if (sales == '') {
            document.getElementById('err_sales').innerHTML = "Wajib diisi..!!";
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal == '0') {
            $('.myalert').simpleAlert({
                message: 'Item kosong..!!'
            })
        } else {

            $.ajax({
                type: 'POST',
                url: "config/simpan_order_penjualan.php",
                data: data2,
                success: function() {
                    location = 'tampil_order_penjualan.php';
                }
            });
        }
    }
</script>

<!-- fungsi panggil alamat pelanggan -->
<script type="text/javascript">
    function panggilPelanggan() {
        var id = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "../penjualan/config/panggil_pelanggan.php",
            data: 'id=' + id,
            success: function(response) {
                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = response;
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi batal -->
<script type="text/javascript">
    function batal() {
        $(".myalert").simpleConfirm({
            title: "Batal..?",
            // message: "Batal..?",
            acceptBtnLabel: 'Ok',
            success: function() {
                $.ajax({
                    type: 'POST',
                    url: "config/batal.php",
                    success: function() {
                        location = 'tampil_order_penjualan.php';
                    }
                })
            }
        })
    }
</script>

<!-- fungsi focus ke jumlah setelah select2 close -->
<script>
    $('#barang').on('select2:close', function() {
        $('#jumlah').focus();
    });
</script>

<!-- =============================================================================================== -->
<script>
    $(document).ready(function() {
        $("select[size=1]").select2();
    });
</script>
<script>
    config = {
        dateFormat: "d-m-Y",
    }
    flatpickr("#tgl", config);
</script>
<script>
    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function hanyaAngka(evt) {
        var kode = (evt.which) ? evt.which : event.keyCode
        if (kode > 31 && (kode < 48 || kode > 57))
            return false;
        return true;
    }
</script>
<!-- =============================================================================================== -->

// ! detail order penjualan
<!-- =============================================================================================== -->
<script type="text/javascript">
    $(document).ready(function() {

        console.log()
        $('.tampil_item_order_penjualan').load('config/tmp_tampil_item_order_penjualan.php');

        $(".tambah").click(function() {
            tambahItem();
        });

        $(".simpan").click(function() {
            simpanSemuaData();
        });

        $(".batal").click(function() {
            batal();
        });


        window.addEventListener("keydown", (code) => {
            // if (code.key == 'Enter') {
            //   tambahItem();
            // }
            // if (code.key == 'Shift') {
            //   simpanSemuaData();
            // }
            if (code.key == 'i') {
                $("#barang").select2('open');
            }
        })


        $('input').on('keypress', function(e) {
            if (e.which == 13) {
                switch ($(this).attr('id')) {
                    case 'barang':
                        $('#jumlah').focus();
                        e.preventDefault();
                        break;
                    case 'jumlah':
                        $('#harga').focus();
                        e.preventDefault();
                        break;
                    case 'harga':
                        $('#tambah').click();
                        e.preventDefault();
                        break;
                }
            }
        });
    });
</script>

<!-- fungsi uppercase pada id -->
<script>
    function uppercase() {

        var x = document.getElementById('id_transaksi_order_penjualan');
        x.value = x.value.toUpperCase();
    }
</script>


<script>
    function tglfokusout() {
        document.getElementById('err_tgl').innerHTML = "";
    }

    function jumlahfokusout() {
        document.getElementById('err_jumlah').innerHTML = "";
    }

    function hargafokusout() {
        document.getElementById('err_harga').innerHTML = "";
    }
</script>

<!-- fyngsi tambah item -->
<script type="text/javascript">
    function tambahItem() {
        var data = $('#form-item').serialize();
        var id_transaksi_order_penjualan = $('#id_transaksi_order_penjualan').val();
        var barang = $('#barang').val();
        var jumlah = $('#jumlah').val();
        var harga = $('#harga').val();

        // var semuadata = data + '&id_transaksi_order_penjualan=' + id_transaksi_order_penjualan;


        if (jumlah == '') {
            document.getElementById("err_jumlah").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_jumlah").innerHTML = "";
        }
        if (harga == '') {

            document.getElementById("err_harga").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_harga").innerHTML = "";
        }
        if (barang == '') {

            document.getElementById("err_barang").innerHTML = "Wajib diisi..!!";
        } else {
            document.getElementById("err_barang").innerHTML = "";
        }

        if (harga != '' && jumlah != '' && barang != '') {
            $.ajax({
                type: 'POST',
                url: "config/tmp_simpan_item_order_penjualan.php",
                data: data,
                success: function() {
                    $('.tampil_item_order_penjualan').load("config/tmp_tampil_item_order_penjualan.php");
                    document.getElementById("form-item").reset();
                    $("#barang").select2({
                        placeholder: "-",
                        initSelection: function(element, callback) {}
                    });

                    $("#barang").select2('open');
                }
            });

            // console.log(data)
        }
    }
</script>

<!-- fungsi simpan semua data -->
<script type="text/javascript">
    function simpanSemuaData() {
        var data2 = $('#form-profil').serialize();
        var id_transaksi_order_penjualan = $('#id_transaksi_order_penjualan').val();
        var tgl = $('#tgl').val();
        var sales = $('#sales').val();
        var pelanggan = $('#pelanggan').val();

        var gtotal = $('#gtotal').val();

        document.getElementById('err_tgl').innerHTML = "";
        document.getElementById('err_sales').innerHTML = "";
        document.getElementById('err_pelanggan').innerHTML = "";

        if (id_transaksi_order_penjualan == '') {
            document.getElementById('err_id_transaksi_order_penjualan').innerHTML = "Wajib diisi..!!";
        } else if (tgl == '') {
            document.getElementById('err_tgl').innerHTML = "Wajib diisi..!!";
        } else if (pelanggan == '') {
            document.getElementById('err_pelanggan').innerHTML = "Wajib diisi..!!";
        } else if (sales == '') {
            document.getElementById('err_sales').innerHTML = "Wajib diisi..!!";
        } else if (tgl != '' && sales != '' && pelanggan != '' && gtotal == '0') {
            $('.myalert').simpleAlert({
                message: 'Item kosong..!!'
            })
        } else {

            $.ajax({
                type: 'POST',
                url: "config/simpan_detail_order_penjualan.php",
                data: data2,
                success: function() {
                    location = 'tampil_order_penjualan.php';
                }
            });
            // console.log(data2);
        }

    }
</script>

<!-- fungsi panggil alamat pelanggan -->
<script type="text/javascript">
    function panggilPelanggan() {
        var id = document.getElementById("pelanggan").value;
        $.ajax({
            type: 'POST',
            url: "../penjualan/config/panggil_pelanggan.php",
            data: 'id=' + id,
            success: function(response) {
                // tmpilkan alamat pel
                document.getElementById("info_pelanggan").innerHTML = response;
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>

<!-- fungsi batal -->
<script type="text/javascript">
    function batal() {
        $(".myalert").simpleConfirm({
            title: "Batal..?",
            // message: "Batal..?",
            acceptBtnLabel: 'Ok',
            success: function() {
                $.ajax({
                    type: 'POST',
                    url: "config/batal.php",
                    success: function() {
                        location = 'tampil_order_penjualan.php';
                    }
                })
            }
        })
    }
</script>

<!-- fungsi focus ke jumlah setelah select2 close -->
<script>
    $('#barang').on('select2:close', function() {
        $('#jumlah').focus();
    });
</script>
<!-- =============================================================================================== -->
<script>
    $(document).ready(function() {
        $("select[size=1]").select2();
    });
</script>
<script>
    config = {
        dateFormat: "d-m-Y",
    }
    flatpickr("#tgl", config);
</script>
<script>
    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function hanyaAngka(evt) {
        var kode = (evt.which) ? evt.which : event.keyCode
        if (kode > 31 && (kode < 48 || kode > 57))
            return false;
        return true;
    }
</script>
<!-- =============================================================================================== -->