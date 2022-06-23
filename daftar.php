<?php
$koneksi = new mysqli("localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header -->
    <div class="jumb ">
        <h1 class="text-center">KOELEK</h1>
        <h4 class="text-center">Situs Jual Beli Elektronik Terpercaya</h4>
    </div>
    <!-- Header End -->
    <!-- Navbar -->
    <nav class="navbar navbar-default ">
        <div class="container">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="index.php">Home</a></li>
                <li role="presentation"><a href="belanja.php">Belanja</a></li>
                <li role="presentation"><a href="checkout.php">Checkout</a></li>
                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li role="presentation"><a href="login.php">Login</a></li>
                    <li role="presentation" class="active"><a href="daftar.php">Daftar</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Sekarang</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>Telepon</label>
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="pass" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button name="daftar" class="btn btn-primary">Daftar</button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST["daftar"])) {
                            $nama = $_POST["nama"];
                            $telepon = $_POST["telepon"];
                            $email = $_POST["email"];
                            $password = $_POST["pass"];
                            $alamat = $_POST["alamat"];

                            // Cek email 
                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan ='$email'");
                            $cocok = $ambil->num_rows;

                            if ($cocok == 1) {
                                echo "<script>alert('Gagal mendaftar karena email telah digunakan');</script>";
                                echo "<script>location='daftar.php';</script>";
                            } else {
                                $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");
                                echo "<script>alert('Sukses mendaftar silahkan melakukan login');</script>";
                                echo "<script>location='login.php';</script>";
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content End -->
</body>

</html>