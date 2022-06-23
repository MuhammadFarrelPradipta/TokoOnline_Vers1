<?php
session_start();
$koneksi = new mysqli("servername", "root", "", "infecthm_dictionary-of-english");

if (!isset($_SESSION["pelanggan"])) {

    echo "<script>alert('Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
                <li role="presentation" class="active"><a href="checkout.php">Checkout</a></li>
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
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
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
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $jumtot; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Belanja</th>
                        <th>Rp.<?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>

            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_kirim">
                            <option value="">Pilih Daerah</option>
                            <?php $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while ($ongkir = $ambil->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $ongkir['id_ongkir'] ?>">
                                    <?php echo $ongkir['nama_provinsi'] ?> -
                                    Rp.<?php echo number_format($ongkir['tarif']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" name="lanjut">Lanjutkan</button>
            </form>

            <?php
            if (isset($_POST["lanjut"])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir = $_POST["id_kirim"];
                $tanggal_pembelian = date("y-m-d");
                $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arongkir = $ambil->fetch_assoc();
                $tarif = $arongkir['tarif'];
                $total_pembelian = $totalbelanja + $tarif;

                $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian) VALUE ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");

                $id_pembelian_baru = $koneksi->insert_id;
                foreach ($_SESSION["belanja"] as $id_produk => $jumlah) {
                    $koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,jumlah) VALUES ('$id_pembelian_baru','$id_produk','$jumlah')");
                }

                // belanja kosong
                unset($_SESSION["belanja"]);
                // ditampilkan ke halaman nota
                echo "<script>alert('Pembelian Sukses');</script>";
                echo "<script>location='index.php';</script>";
            }
            ?>
        </div>
    </section>
    <!-- Content End -->
    <?php echo "<pre>" ?>
    <?php print_r($_SESSION["pelanggan"]); ?>
    <?php print_r($_SESSION["belanja"]); ?>
    <?php echo "</pre>" ?>
</body>

</html>