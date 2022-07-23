<?php
include '../config/koneksi.php';
session_start();
if (isset($_SESSION['user'])) {
    echo "<script>location='../index.php';</script>";
    exit();
};
?>


<html>

<head>
    <title>Login Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../aset/bootstrap-4.5.3/css/bootstrap.min.css">

    <link rel="icon" type="image/png" href="../gambar/pakis11.png">

</head>

<style type="text/css">
    body {

        margin-top: 40px;
        background-color: lavender;

        background: url(../gambar/bg2.jpg) no-repeat fixed;
        background-position: center;
        background-size: 100% 100%;


    }

    h2 {
        color: lightgrey;
    }
</style>

<body>
    <form method="post">
        <!-- content -->
        <div class="container">
            <div class="rows text-center">
                <div class="col-md-12">
                    <br><br>
                    <h2>CV. Pakis Jaya Abadi</h2>

                    <br>
                </div>
            </div>
            <!-- card -->
            <div class="col-md-4 offset-md-4">
                <div class="card bg-success text-white">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control mb-3" placeholder="Username" autocomplete="off" autofocus required>
                        <label>Password</label>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password" autocomplete="off" required>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                    <div class="card-footer">
                        <!-- Belum Punya Akun ? <a href="m_registrasi.php">Klik disini</a> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>

<?php

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    if (mysqli_num_rows($query) == 1) {

        $lihat = mysqli_fetch_assoc($query);

        if (password_verify($password, $lihat['password'])) {

            $_SESSION['user'] = $lihat;

            echo "<script>location='../index.php'</script>";
        } else {

            echo "<script>alert('username atau password salah..!!')</script>";
        }
    } else {

        echo "<script>alert('username atau password salah..!!')</script>";
    }
}

?>