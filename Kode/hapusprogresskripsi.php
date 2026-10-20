<?php
    include("includes/config.php");
    if (isset($_GET['hapusprogresskripsi'])) {
        $ID = $_GET["hapusprogresskripsi"];
        mysqli_query($conn, "DELETE FROM progresSkripsi
                    WHERE id_progres = '$ID'");
        echo "<script>
            alert('DATA BERHASIL DIHAPUS');
            document.location='inputprogresskripsi.php'
        </script>";
    }
?>