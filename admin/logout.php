<?php
    session_destroy();
    echo "<script>alert('Logout telah berhasil');</script>";
    echo "<script>location='login.php';</script>";
?>