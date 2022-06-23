<?php
session_start();


$koneksi = new mysqli("servername", "root", "", "localhost");

if (empty($_SESSION["belanja"]) or !isset($_SESSION["belanja"])) {
    echo "<script>alert('Silahkan berbelanja');</script>";
    echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoping</title>
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
                <li role="presentation" class="active"><a href="belanja.php">Belanja</a></li>
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

    <!-- Contain -->
    <section class="content">
        <div class="container">
            <h1>Barang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Harga Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($_SESSION['belanja'] as $id_produk => $jumlah) : ?>
                        <!-- Menampilkan produk -->
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $jumtot = $pecah['harga_produk'] * $jumlah;
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah['nama_produk']; ?></td>
                            <td>Rp.<?php echo  number_format($pecah['harga_produk']); ?></td>
                            <td><?php echo $jumlah;  ?></td>
                            <td>Rp.<?php echo number_format($jumtot); ?></td>
                            <td>
                                <a href="hapusbelanja.php?id=<?php echo $id_produk ?>" class="btn btn-danger"> HAPUS </a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-primary">Belanja Lagi</a>
            <a href="checkout.php" class="btn btn-default">Selesai Belanja</a>
        </div>
    </section>
    <!-- Content End -->

    <!-- Footer -->

    <!-- Footer End -->

</body>

</html>