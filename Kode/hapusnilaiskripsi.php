<?php
    include("includes/config.php");
    if (isset($_GET['hapusnilaiskripsi'])) {
        $NPM = $_GET["hapusnilaiskripsi"];
        mysqli_query($conn, "DELETE FROM nilaiSkripsi
                    WHERE id_nilai = '$ID'");
        echo "<script>
            alert('DATA BERHASIL DIHAPUS');
            document.location='inputnilaiskripsi.php'
        </script>";
    }
?>