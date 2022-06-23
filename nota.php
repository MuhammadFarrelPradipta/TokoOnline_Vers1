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
    <title>Nota</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-default ">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="belanja.php">Belanja</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <section class="content">
        <div class="container">
            <h1>Detail Pembelian</h1>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pelanggan ='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>
            <pre><?php print_r($detail) ?></pre>
            <strong>Nama : <?php echo $detail['nama_pelanggan'] ?></strong>
            <p>
                Telepon Pelanggan: <?php echo $detail['telepon_pelanggan'] ?> <br>
                Email Pelanggan: <?php echo $detail['email_pelanggan'] ?>
            </p>
            <p>
                Total Pembelian : <?php echo $detail['total_pembelian'] ?> <br>
                Tanggal Pembelian : <?php echo $detail['tanggal_pembelian'] ?>
            </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>nama produk</th>
                        <th>harga</th>
                        <th>jumlah</th>
                        <th>subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
            ON pembelian_produk.id_produk = produk.id_produk 
            WHERE pembelian_produk.id_pembelian ='$_GET[id]'"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $number; ?></td>
                            <td><?php echo $pecah["nama_produk"]; ?></td>
                            <td><?php echo $pecah["harga_produk"]; ?></td>
                            <td><?php echo $pecah["jumlah"]; ?></td>
                            <td><?php echo $pecah["harga_produk"] * $pecah["jumlah"]; ?></td>
                        </tr>
                        <?php $number++; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>