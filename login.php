<?php
session_start();

$koneksi = new mysqli("servername", "root", "", "infecthm_dictionary-of-english");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <!-- Header -->
    <div class="jumb">
        <h1 class="text-center">KOELEK</h1>
        <h4 class="text-center">Situs Jual Beli Elektronik Terpercaya</h4>
    </div>
    <!-- Header End -->
   <!-- Navbar -->
 <nav class="navbar navbar-default ">
        <div class="container">
            <ul class="nav nav-tabs">
                <li role="presentation" ><a href="index.php">Home</a></li>
                <li role="presentation" ><a href="belanja.php">Belanja</a></li>
                <li role="presentation" ><a href="checkout.php">Checkout</a></li>
                <?php if (isset($_SESSION["pelanggan"])):?>
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                <?php else :?>
                <li role="presentation" class="active"><a href="login.php">Login</a></li>
                <li role="presentation"><a href="daftar.php">Daftar</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- Content -->
    <section class="content">
        <div class="container">
            <br>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">LOGIN SEKARANG</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pass">
                            </div>
                            <button class="btn btn-primary" name="save">Login</button>
                        </form>
                        <?php
                        if (isset($_POST["save"])) {
                            $email = $_POST["email"];
                            $pass = $_POST["pass"]; 
                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$pass'");
                            $akun = $ambil->num_rows;
                            if ($akun == 1) {
                                $akuns = $ambil->fetch_assoc();
                                $_SESSION["pelanggan"] = $akuns;
                                echo "<script>alert('Berhasil melakukan login')</script>";
                                echo "<script>location='checkout.php'</script>";
                            } else {
                                echo "<script>alert('Gagal melakukan login')</script>";
                                echo "<script>location='login.php'</script>";
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content End -->
</body>

</html>