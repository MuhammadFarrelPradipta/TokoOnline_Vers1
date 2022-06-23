<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Pelanggan</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label>Email Pelanggan</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Telepon Pelanggan</label>
            <input type="telp" class="form-control" name="telepon">
        </div>
        <button class="btn btn-primary" name="save" >Simpan</button>
    </form>
</body>
</html>

<?php 
    if (isset($_POST['save'])) {
        $koneksi->query("INSERT INTO pelanggan 
        (nama_pelanggan,email_pelanggan,telepon_pelanggan)
        VALUES ('$_POST[nama]','$_POST[email]','$_POST[telepon]') ");
        
        echo "<div class='alert alert-info'> Data Telah Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
    }
?>