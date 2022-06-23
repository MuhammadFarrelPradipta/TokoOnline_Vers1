

<?php
    $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $pecah=$ambil->fetch_assoc();
    
    session_start();
    
    echo "<pre>";
    print_r($pecah);
    echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mengubah Informasi Produk</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
        </div>
        <div class="form-group">
            <label>Harga (Rupiah)</label>
            <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
        </div>
        <div class="form-group">
            <label>Berat (Gram)</label>
            <input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat']; ?>">
        </div>
        <div class="form-group">
            <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="200">
        </div>
        <div class="form-group">
            <label>Ganti foto</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="5" ><?php echo $pecah['deskripsi_produk']?></textarea>
        </div>
        <button class="btn btn-primary" name="ubah" >Mengubah</button>
    </form>
</body>
</html>
    <?php 
        if (isset($_POST['ubah'])) {
            $namafoto=$_FILES['foto']['name'];
            $lokasifoto=$_FILES['foto']['tmp_name'];
            
            if (!empty($lokasifoto)) {
                move_uploaded_file($lokasifoto,"../foto_produk/$namafoto");

                $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
                harga_produk='$_POST[harga]',berat='$_POST[berat]',foto_produk='$namafoto',
                deskripsi_produk='$_POST[deskripsi]'
                WHERE id_produk='$_GET[id]'");
            }else{
                $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
                harga_produk='$_POST[harga]',berat='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]',
                WHERE id_produk='$_GET[id]'");
            }
            echo "<script>alert('data produk telah diubah');</script>";
            echo "<script>location ='index.php?halaman=produk';</script>";
        }
           
       
    ?>