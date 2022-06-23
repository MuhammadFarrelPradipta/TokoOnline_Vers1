
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Barang yang dibeli</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $number=1;?>
            <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $pecah["nama_pelanggan"];?></td>
                    <td><?php echo $pecah["tanggal_pembelian"];?></td>
                    <td><?php echo $pecah["total_pembelian"];?></td>
                    <td>
                        <a href="index.php?halaman=detail&id=<?php echo $pecah["id_pembelian"]; ?> " class="btn-primary btn">Detail</a>
                    </td>
                </tr>
            <?php $number++ ;?>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>