<?php
session_start();
$koneksi = new mysqli("localhost", "root", "");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <br />
                <br />
                <h2>Selamat Datang Administrator</h2>
                <h5>Lakukan Login untuk mendapatkan akses</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 bg-primary">
                <h4 class="text-center">LOGIN ADMIN</h4>
                <form role="form" method="post">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <input type="text" class="form-control" name="user">
                    </div>
                    <br>
                    <div class="form group input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" class="form-control" name="pass">
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                    <button class="btn btn-success" name="login">Login Now</button>
                    <hr>
                </form>
                <?php
                if (isset($_POST['login'])) {
                    $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
                      AND password='$_POST[pass]'");
                    $yangcocok = $ambil->num_rows;
                    if ($yangcocok == 1) {
                        $_SESSION['admin'] = $ambil->fetch_assoc();
                        echo "<div class='alert alert-info'>Login Berhasil</div>";
                        echo "< http-emetaquiv='refresh' content='1;url=index.php'></meta>";
                    } else {
                        echo "<div class='alert alert-danger'>Login Gagal</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'></meta>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>