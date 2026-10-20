<?php
    session_start();
    $_SESSION["admin_USER"];
    unset($_SESSION["admin_USER"]);

    session_unset();
    // session_unset hanya menghapus sesi utk penggunaan.
    // Sesi ini masih ada di komputer pengguna dgn menggunakan session_unset,
    // variabel masih ada

    session_destroy();
    header("location:login.php")
?>