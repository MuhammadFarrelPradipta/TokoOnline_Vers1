<?php 

    session_start();
    $id_produk=$_GET['id'];

    // jika sudah ada 
    if (isset($_SESSION['belanja'])) {
        $_SESSION['belanja'][$id_produk] += 1;
    }
    // jika belum ada 
    else{
        $_SESSION['belanja'][$id_produk] = 1;
    }
    echo "<pre>";
    print_r($_SESSION);      
    echo "</pre";

    echo "<script>alert('produk telah terbeli');</script>";
    echo "<script>location='belanja.php';</script>";

?>