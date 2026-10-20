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
            $id_progres = $_POST['progresID'];
            $mhs_NPM = $_POST['npmMHS'];
            $dosen_NIDN = $_POST['nidnDOSEN'];
            $ringkasan = $_POST['ringkas'];
            $status = $_POST['status']; 

            mysqli_query($conn, "insert into progresSkripsi values( '$id_progres', '$mhs_NPM', 
                '$dosen_NIDN', '$ringkasan', '$status')"); //memasukkan data ke dalam tabel
            header("location:inputprogresskripsi.php");
        } 

        // pencarian data
        if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "SELECT * FROM progresSkripsi, bimbinganSkripsi
            where bimbinganSkripsi.mhs_NPM = progresSkripsi.mhs_NPM AND progresSkripsi.id_progres LIKE '%".$search."%'");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM progresSkripsi, bimbinganSkripsi
            where bimbinganSkripsi.mhs_NPM = progresSkripsi.mhs_NPM");
        }
        // end pencarian data
        $dataP = mysqli_query($conn, "select * from progresSkripsi");
        $data = mysqli_query($conn, "select * from bimbinganSkripsi");
        $data2 = mysqli_query($conn, "select * from bimbinganSkripsi");
        
    ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <form method="POST" enctype="multipart/form-data"> <!-- harus pakai si enctype kalau ga upload file ga berfungsi -->
        <div class="row mb-3 mt-5"> 
            <label for="progresID" class="col-sm-2 col-form-label">Progres ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="progresID" name="progresID" 
                placeholder="Isikan ID Progres (P001)" maxlength="4" required="">
            </div>
        </div>
        <div class="row mb-3 mt-5">
            <label for="npmMHS" class="col-sm-2 col-form-label">NPM Mahasiswa</label>
            <div class="col-sm-10">
                <select class="form-control" id="npmMHS" name="npmMHS" placeholder="Nomor Pokok Mahasiswa" required="">
                    <option>Cari NPM Mahasiswa</option>
                    <?php while ($row = mysqli_fetch_array($data))
                    { ?>
                        <option value="<?php echo $row["mhs_NPM"]?>">
                            <?php echo $row["mhs_NPM"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5">
            <label for="nidnDOSEN" class="col-sm-2 col-form-label">NIDN DOSEN</label>
            <div class="col-sm-10">
                <select class="form-control" id="nidnDOSEN" name="nidnDOSEN" placeholder="Isikan NIDN Dosen" required="">
                    <option>Cari Dosen</option>
                    <?php while ($row = mysqli_fetch_array($data2))
                    { ?>
                        <option value="<?php echo $row["dosen_NIDN"]?>">
                            <?php echo $row["dosen_NIDN"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="ringkas" class="col-sm-2 col-form-label">Ringkasan Progres Skripsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ringkas" name="ringkas" placeholder="Isikan Ringkasan Progres Skripsi" required="">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="status" class="col-sm-2 col-form-label">Status Progres</label>
            <div class="col-sm-10">
                <select class="form-control" id="status" name="status" placeholder="Pilih Status Progres Skripsi" required="">
                    <option value="diterima">Diterima</option>
                    <option value="revisi">Revisi</option>
                </select>
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
            <h1 class="display-5">Daftar Progres Skripsi</h1>
    </div>
    
    <!-- form pencarian data -->
    <form method="POST">
        <div class="form-group row mt-5 mb-3">
            <label for="seacrh" class="col-sm-2">Cari ID Progres</label>
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search"
                value="<?php if(isset($_POST["search"]))
                {echo $_POST["search"];}?>" placeholder="Cari ID Progres">
            </div>
            <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
        </div>
    </form>
    <!-- end pencarian data -->

    <table class="table table-striped table-success table-hover">
        <tr class="info"> <!-- membuat judul -->
            <th>ID Progres</th>
            <th>NPM</th>
            <th>NIDN Dosen</th>
            <th>Ringkasan</th>
            <th>Status</th>
            <th colspan="2" style="text-align: center;">AKSI</th>
        </tr>
        
        <?php { ?>
            <?php while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> <!-- menampilkan data dari tabel kategori -->
                        <td><?php echo $row['id_progres']; ?> </td>
                        <td><?php echo $row['mhs_NPM']; ?> </td>
                        <td><?php echo $row['dosen_NIDN']; ?> </td>
                        <td><?php echo $row['ringkasan']; ?> </td>
                        <td><?php echo $row['status']; ?> </td>
                        <td>
                            <a href="editprogresskripsi.php?ubahprogresskripsi=<?php echo $row["id_progres"]?>" 
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
                            <a href="hapusprogresskripsi.php?hapusprogresskripsi=<?php echo $row["id_progres"]?>" 
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