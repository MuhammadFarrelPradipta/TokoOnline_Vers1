<h1>Hapus Pelanggan</h1>
<?php
     $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
     $pecah=$ambil->fetch_assoc();
     $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
     echo "<script> alert('Produk telah terhapus'); </script>";
     echo "<script> location = 'index.php?halaman=pelanggan' ;</script>";
?>