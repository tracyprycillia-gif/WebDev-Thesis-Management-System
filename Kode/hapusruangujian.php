<?php
    include("includes/config.php");
    if (isset($_GET['hapusruangujian'])) {
        $NPM = $_GET["hapusruangujian"];
        mysqli_query($conn, "DELETE FROM ruangUjian
                    WHERE id_ruang = '$ID'");
        echo "<script>
            alert('DATA BERHASIL DIHAPUS');
            document.location='inputruangujian.php'
        </script>";
    }
?>