<?php
    $servername = "localhost";
    $username = "masukkan_username";
    $password = "masukkan_password";
    $dbname = "masukkan_nama_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("koneksi failed: " . $conn->connect_error);
    }
?>
