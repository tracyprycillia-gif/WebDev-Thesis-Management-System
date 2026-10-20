<?php
    include("includes/config.php");
    if (isset($_GET['hapusdosen'])) {
        $NIDN = $_GET["hapusdosen"];
        mysqli_query($conn, "DELETE FROM dosen
                    WHERE dosen_NIDN = '$NIDN'");
        echo "<script>
            alert('DATA BERHASIL DIHAPUS');
            document.location='inputdosen.php'
        </script>";
    }
?>