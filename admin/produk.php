<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Data Produk</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>nama</th>
                <th>foto</th>
                <th>harga</th>
                <th>berat</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $number=1;?>
            <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td>
                        <img src="../foto_produk/<?php echo $pecah["foto_produk"];?>" width="100">
                    </td>
                    <td><?php echo $pecah["harga_produk"];?></td>
                    <td><?php echo $pecah["berat"];?></td>
                    <td>
                        <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']?>" class="btn-primary btn">hapus</a>
                        <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'] ?>" class="btn-primary btn">ubah</a>
                    </td>
                </tr>
            <?php $number++ ;?>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php?halaman=tambahproduk">Tambah Data</a>
</body>

</html>

