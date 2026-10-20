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
</head>
<body>
    <?php
    include("includes/config.php"); //file config.php utk koneksi basis data 
        if(isset($_POST['Simpan'])) //mengecek apakah tombol simpan sudah dipilih
        //klik atau belum
            { 
            $mhs_NPM = $_POST['npmMHS'];
            $peserta_SEMT = $_POST['SEMT'];
            $peserta_THAKD = $_POST['THAKD'];
            $peserta_TGLDAFTAR = $_POST['TGLD'];
            $peserta_Judul = $_POST['Judul'];
            
            $peserta_Dokumen = $_FILES['Dokumen']['name'];
            $dokumen_tmp = $_FILES['Dokumen']['tmp_name'];
            move_uploaded_file($dokumen_tmp,'images/'.$peserta_Dokumen);

            $dosen_NIDN = $_POST['nidnDOSEN'];

            mysqli_query($conn, "insert into pesertaskripsi values('$mhs_NPM', 
            '$peserta_SEMT', '$peserta_THAKD', '$peserta_TGLDAFTAR', '$peserta_Judul',
            '$peserta_Dokumen', '$dosen_NIDN')"); //memasukkan data ke dalam tabel
            header("location:inputpesertaskripsi.php");
            } 
        $query = mysqli_query($conn, "select * from pesertaskripsi,dosen,mahasiswa
        where mahasiswa.mhs_NPM = pesertaskripsi.mhs_NPM and pesertaskripsi.dosen_NIDN =
        dosen.dosen_NIDN");
        $datamhs = mysqli_query($conn, "select * from mahasiswa");
        $datadosen = mysqli_query($conn, "select * from dosen");
        
    ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <form method="POST" enctype="multipart/form-data"> <!-- harus pakai si enctype kalau ga upload file ga berfungsi -->
        <div class="row mb-3 mt-5">
            <label for="npmMHS" class="col-sm-2 col-form-label">NPM Mahasiswa</label>
            <div class="col-sm-10">
                <select class="form-control" id="npmMHS" name="npmMHS" placeholder="Nomor Pokok Mahasiswa">
                    <option>Cari NPM Mahasiswa</option>
                    <?php while ($row = mysqli_fetch_array($datamhs))
                    { ?>
                        <option value="<?php echo $row["mhs_NPM"]?>">
                            <?php echo $row["mhs_NPM"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="SEMT" class="col-sm-2 col-form-label">Semester</label>
            <div class="col-sm-10">
                <select class="form-control" id="SEMT" name="SEMT" placeholder="Pilih Semester">
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="THAKD" class="col-sm-2 col-form-label">Tahun Akademik</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="THAKD" name="THAKD" placeholder="2025-2026 atau 2024-2025">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="TGLD" class="col-sm-2 col-form-label">Tanggal Daftar</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="TGLD" name="TGLD" placeholder="Isikan Tanggal Daftar">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="Judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Judul" name="Judul" placeholder="Tulis Judul Skripsi">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="Dokumen" class="col-sm-2 col-form-label">Unggah Dokumen</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="Dokumen" name="Dokumen">
                <p class="help-block">Unggah file dokumen</p>
            </div>
        </div>
        <div class="row mb-3 mt-5">
            <label for="nidnDOSEN" class="col-sm-2 col-form-label">NIDN Dosen</label>
            <div class="col-sm-10">                
                <select class="form-control" id="nidnDOSEN" name="nidnDOSEN">
                    <option>Cari NIDN Dosen</option>
                    <?php while ($row = mysqli_fetch_array($datadosen))
                    { ?>
                        <option value="<?php echo $row["dosen_NIDN"]?>">
                            <?php echo $row["dosen_NIDN"]?>
                            <?php echo $row["dosen_Nama"]?>
                        </option>
                    <?php } ?>
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
            <h1 class="display-5">Daftar Peserta Skripsi</h1>
    </div>

    <table class="table table-striped table-success">
        <tr class="info"> <!-- membuat judul -->
            <th>NPM</th>
            <th>Semester</th>
            <th>Tahun Akademik</th>
            <th>Tanggal Daftar</th>
            <th>Judul Skripsi</th>
            <th>Dokumen Skripsi</th>
            <th>NIDN Dosen</th>
            <th>Nama Dosen Pembimbing</th>
        </tr>
        
        <?php { ?>
            <?php while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> <!-- menampilkan data dari tabel kategori -->
                        <td><?php echo $row['mhs_NPM']; ?> </td>
                        <td><?php echo $row['peserta_SEMT']; ?> </td>
                        <td><?php echo $row['peserta_THAKD']; ?> </td>
                        <td><?php echo $row['peserta_TGLDAFTAR']; ?> </td>
                        <td><?php echo $row['peserta_Judul']; ?> </td>
                        <td><?php if ($row['peserta_Dokumen']=="") {
                            echo "<img src='images/images.jpg' width='88'/>"; 
                            // ini buat default jadi kalau ga dimasukin dia muncul gambar ini
                        }else{ ?>
                                <img src="images/<?php echo $row['peserta_Dokumen'] ?>"
                                width="88" class="img-responsive"/>
                                <?php }  ?> 
                            </td>
                            <td><?php echo $row['dosen_NIDN']; ?> </td>
                            <td><?php echo $row['dosen_Nama']; ?> </td>
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