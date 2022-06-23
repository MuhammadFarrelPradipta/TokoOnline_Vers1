<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Detail Pembelian</h1>
    <?php 
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
    ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
    WHERE pembelian.id_pelanggan ='$_GET[id]'");
    $detail= $ambil->fetch_assoc();
    ?>
    <strong>Nama : <?php echo $detail ['nama_pelanggan']; ?></strong>
    <p>
        Telepon Pelanggan: <?php echo $detail ['telepon_pelanggan']?> <br>
        Email Pelanggan: <?php echo $detail ['email_pelanggan']?>
    </p>
    <p>
        Total Pembelian : <?php echo $detail ['total_pembelian']?> <br>
        Tanggal Pembelian : <?php echo $detail ['tanggal_pembelian']?>
    </p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>nama produk</th>
                <th>harga</th>
                <th>jumlah</th>
                <th>subtotal</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $number=1;?>
            <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
            ON pembelian_produk.id_produk = produk.id_produk 
            WHERE pembelian_produk.id_pembelian ='$_GET[id]'"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td><?php echo $pecah["harga_produk"];?></td>
                    <td><?php echo $pecah["jumlah"];?></td>
                    <td><?php echo $pecah["harga_produk"]* $pecah["jumlah"];?></td>
                    <td>
                        <a href="" class="btn-primary btn">hapus</a>
                        <a href="" class="btn-primary btn">ubah</a>
                    </td>
                </tr>
            <?php $number++ ;?>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>