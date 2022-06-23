<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Tambah Produk</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>nama</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label>Harga (Rupiah)</label>
            <input type="number" class="form-control" name="harga">
        </div>
        <div class="form-group">
            <label>Berat (Gram)</label>
            <input type="number" class="form-control" name="berat">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <button class="btn btn-primary" name="save">Simpan</button>
    </form>
</body>

</html>

<?php
if (isset($_POST['save'])) {
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_produk/" . $nama);
    $koneksi->query("INSERT INTO produk 
        (nama_produk,harga_produk,berat,foto_produk,deskripsi_produk)
        VALUES ('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]') ");

    echo "<div class='alert alert-info'> Data Telah Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>