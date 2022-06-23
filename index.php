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
    <title>KOELEK|TOKO ELEKTRONIK</title>
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
    <div class="jumb">
        <h1 class="text-center">KOELEK</h1>
        <h4 class="text-center">Situs Jual Beli Elektronik Terpercaya</h4>
    </div>
    <!-- Header End -->
    <!-- Navbar -->
    <nav class="navbar navbar-default ">
        <div class="container">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="index.php">Home</a></li>
                <li role="presentation"><a href="belanja.php">Belanja</a></li>
                <li role="presentation"><a href="checkout.php">Checkout</a></li>
                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li role="presentation"><a href="login.php">Login</a></li>
                    <li role="presentation"><a href="daftar.php">Daftar</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Content -->
    <section class="content">
        <div class="container">
            <h2>Produk Terbaru Kita</h2>
            <div class="row">


                <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while ($bagian = $ambil->fetch_assoc()) : ?>
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $bagian['foto_produk']; ?>">
                            <div class="caption">
                                <h3><?php echo $bagian['nama_produk']; ?></h3>
                                <h5><?php echo number_format($bagian['harga_produk']); ?></h5>
                            </div>
                            <a href="beli.php?id=<?php echo $bagian['id_produk']; ?>" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                <?php endwhile; ?>


            </div>
        </div>
    </section>
    <!-- Content End -->

    <!-- Footer -->
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Alamat Perusahaan</h3>
                    <br>
                    <p>Sebuah perusahaan elektronik yang berada di purwokerto kabupaten banyumas.Daerah tersebut berada di Provinsi Jawa Tengah dan Negara Indonesia</p>
                </div>
                <div class="col-sm-6">
                    <h3>KOELEK</h3>
                    <br>
                    <p>Sebuah perusahaan E-Commerce dibidang teknologi yang berdiri baru baru ini dan terpercaya.KOELEK merupakan singkatan dari Toko Elektronik yang menjual berbagai macam barang elektronik </p>
                </div>
            </div>
        </div>
        <p class="text-center b">TERIMA KASIH TELAH MENGUNJUNGI</p>
    </section>
    <!-- Footer End -->
</body>

</html>