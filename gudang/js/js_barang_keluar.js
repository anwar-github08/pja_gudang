// TODO: =============================================================== event ====================================================
$(document).ready(function () {
  $(".tampil_item_barang_gudang").load(
    "config/tmp_tampil_item_barang_gudang.php"
  );

  $(".tambah").click(function () {
    tambahItem();
  });

  $(".simpan").click(function () {
    simpanSemuaData();
  });

  $(".batal").click(function () {
    batal();
  });
  window.addEventListener("keydown", (code) => {
    // if (code.key == 'Enter') {
    //   tambahItem();
    // }
    // if (code.key == 'Shift') {
    //   simpanSemuaData();
    // }
    if (code.key == "i") {
      $("#barang").select2("open");
    }
  });

  $("#barang").on("select2:close", function () {
    $("#jumlah").focus();
  });

  $("input").on("keypress", function (e) {
    if (e.which == 13) {
      switch ($(this).attr("id")) {
        case "barang":
          $("#jumlah").focus();
          e.preventDefault();
          break;
        case "jumlah":
          $("#tambah").click();
          e.preventDefault();
          break;
      }
    }
  });
});

// TODO: ====================================================== function ==============================================
function tglfokusout() {
  document.getElementById("err_tgl").innerHTML = "";
}

function jumlahfokusout() {
  document.getElementById("err_jumlah").innerHTML = "";
}

function tambahItem() {
  var data = $("#form-item").serialize();
  var barang = $("#barang").val();
  var jumlah = $("#jumlah").val();

  if (jumlah == "") {
    document.getElementById("err_jumlah").innerHTML = "Wajib diisi..!!";
  } else {
    document.getElementById("err_jumlah").innerHTML = "";
  }

  if (barang == "") {
    document.getElementById("err_barang").innerHTML = "Wajib diisi..!!";
  } else {
    document.getElementById("err_barang").innerHTML = "";
  }

  if (jumlah != "" && barang != "") {
    $.ajax({
      type: "POST",
      url: "config/tmp_simpan_item_barang_gudang.php",
      data: data,
      success: function () {
        $(".tampil_item_barang_gudang").load(
          "config/tmp_tampil_item_barang_gudang.php"
        );
        document.getElementById("form-item").reset();
        $("#barang").select2({
          placeholder: "-",
          initSelection: function (element, callback) {},
        });

        $("#barang").select2("open");
      },
    });
  }
}

function simpanSemuaData() {
  var data2 = $("#form-profil").serialize();
  var tgl = $("#tgl").val();
  var sales = $("#sales").val();
  var pelanggan = $("#pelanggan").val();
  var total_barang = $("#total_barang").val();

  document.getElementById("err_tgl").innerHTML = "";
  document.getElementById("err_sales").innerHTML = "";
  document.getElementById("err_pelanggan").innerHTML = "";

  if (tgl == "") {
    document.getElementById("err_tgl").innerHTML = "Wajib diisi..!!";
  } else if (sales == "-") {
    document.getElementById("err_sales").innerHTML = "Wajib diisi..!!";
  } else if (pelanggan == "-") {
    document.getElementById("err_pelanggan").innerHTML = "Wajib diisi..!!";
  }

  // jika tidak ada item barang
  else if (total_barang == 1) {
    $(".myalert").simpleAlert({
      message: "Item kosong..!!",
    });
  } else {
    $.ajax({
      type: "POST",
      url: "config/simpan_barang_keluar.php",
      data: data2,
      success: function () {
        location = "tampil_barang_keluar.php";
      },
    });
  }
}

function batal() {
  $(".myalert").simpleConfirm({
    title: "Batal..?",
    // message: "Batal..?",
    acceptBtnLabel: "Ok",
    success: function () {
      $.ajax({
        type: "POST",
        url: "config/batal.php",
        success: function () {
          location = "tampil_barang_keluar.php";
        },
      });
    },
  });
}

// TODO: select2
$(document).ready(function () {
  $("select[size=1]").select2();
});

// TODO: flatpicekr tgl
config = {
  dateFormat: "d-m-Y",
};
flatpickr("#tgl", config);

// TODO: hanya angka
function hanyaAngka(evt) {
  var kode = evt.which ? evt.which : event.keyCode;
  if (kode > 31 && (kode < 48 || kode > 57)) return false;
  return true;
}
