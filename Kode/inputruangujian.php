<!DOCTYPE html>
<html lang="en">
    <?php
    ob_start();
    session_start();
    if (!isset($_SESSION['useremail'])) 
    header("location:login.php");
    ?>    
    <?php
    include "bagiankode/head.php";
    ?>    
    <body class="sb-nav-fixed">
        <?php
            include "bagiankode/menunav.php";
        ?>
        <div id="layoutSidenav">
            <?php
                include "bagiankode/menu.php";
            ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css"/>
</head>
<body>
    <?php
    include("includes/config.php"); //file config.php utk koneksi basis data 
        if(isset($_POST['Simpan'])) //mengecek apakah tombol simpan sudah dipilih
        //klik atau belum
            { 
            $id_ruang = $_POST['ruangID'];
            $nama_ruang = $_POST['namaRuang'];
            $lokasi = $_POST['lokasi'];
            $kapasitas = $_POST['kapasitas'];

            mysqli_query($conn, "insert into ruangUjian values('$id_ruang', '$nama_ruang', 
             '$lokasi', '$kapasitas')"); //memasukkan data ke dalam tabel
            header("location:inputruangujian.php");
            }
        // pencarian data
        if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "SELECT * FROM ruangUjian
            where id_ruang LIKE '%".$search."%'");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM ruangUjian");
        }
    ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3 mt-5">
            <label for="ruangID" class="col-sm-2 col-form-label">Ruang ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ruangID" name="ruangID" 
                placeholder="Isikan Ruang ID (R001)" maxlength="4" required="">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="namaRuang" class="col-sm-2 col-form-label">Nama Ruang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namaRuang" name="namaRuang" 
                placeholder="Isikan Nama Ruang Ujian">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Ruang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lokasi" name="lokasi"
                placeholder="Isikan Lokasi Ruang Ujian">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas Ruang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kapasitas" name="kapasitas" 
                placeholder="Isikan Kapasitas Ruang Ujian">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-2"></div>
            <div class="col-10">
                <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
                <input type="reset" class="btn btn-danger" value="Batal" name="Batal">
            </div> <!-- div penutup class col-10 -->
        </div> <!-- div penutup class form group -->
    </form>
    <div class="1"></div>
    </div> <!-- div penutup class row -->

    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="jumbotron mt-5 mb-3">
            <h1 class="display-5">Daftar Ruang</h1>
    </div>

    <!-- form pencarian data -->
    <form method="POST">
        <div class="form-group row mt-5 mb-3">
            <label for="seacrh" class="col-sm-2">Cari ID Ruang</label>
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search"
                value="<?php if(isset($_POST["search"]))
                {echo $_POST["search"];}?>" placeholder="Cari ID Ruang Ujian">
            </div>
            <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
        </div>
    </form>
    <!-- end pencarian data -->

    <table class="table table-striped table-success">
        <tr class="info"> <!-- membuat judul -->
            <th>ID</th>
            <th>Nama Ruang</th>
            <th>Lokasi Ruang</th>
            <th>Kapasitas Ruang</th>
            <th colspan="2" style="text-align: center;">AKSI</th>
        </tr>
        
        <?php { ?>
            <?php while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> <!-- menampilkan data dari tabel kategori -->
                        <td><?php echo $row['id_ruang']; ?> </td>
                        <td><?php echo $row['nama_ruang']; ?> </td>
                        <td><?php echo $row['lokasi']; ?> </td>
                        <td><?php echo $row['kapasitas']; ?> </td>
                        <td>
                            <a href="editruangujian.php?ubahruangujian=<?php echo $row["id_ruang"]?>"
                            class="btn btn-success" title="EDIT">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 
                                0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 
                                0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 
                                1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 
                                .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg> 
                        </td>
                        <td>
                            <a href="hapusruangujian.php?hapusujian=<?php echo $row["id_ruang"]?>" 
                            class="btn btn-danger" title="HAPUS">
                            <i class="bi bi-trash"></i>
                        </td>
                    </tr>
            <?php } ?>
        <?php } ?>
    </table>
    </div> <!-- penutup class col-10 utk tabel -->
    </div> <!-- penutup class row utk tabel -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

</body>
                </div>
            </main>
            <?php
                include "bagiankode/footer.php";
            ?>
        </div>
    </div>
    <?php
        include "bagiankode/jsscript.php";
    ?>
</body>
</html>