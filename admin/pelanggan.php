
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Pelanggan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email Pelanggan</th>
                <th>Telepon Pelanggan</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $number=1;?>
            <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $pecah["nama_pelanggan"];?></td>
                    <td><?php echo $pecah["email_pelanggan"];?></td>
                    <td><?php echo $pecah["telepon_pelanggan"];?></td>
                    <td>
                        <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']?>" class="btn-primary btn">hapus</a>
                        <a href="" class="btn-primary btn">ubah</a>
                    </td>
                </tr>
            <?php $number++ ;?>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php?halaman=tambahpelanggan">Tambah Data</a>
</body>
</html>