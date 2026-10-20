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
        // menerima data yang akan diubah
        $NPM = $_GET["ubahujianskripsi"];
        $edit = mysqli_query($conn, "SELECT * FROM ujianSkripsi WHERE mhs_NPM = '$NPM'");
        $row_edit = mysqli_fetch_array($edit);

        $edit2 = mysqli_query($conn, "SELECT * FROM bimbinganSkripsi WHERE mhs_NPM = '$NPM'");
        $row_edit2 = mysqli_fetch_array($edit2);

         //ambil data ID Ruang dari ujian skripsi
        $ruang = $row_edit["id_ruang"];

        //ambil data dari ruang ujian
        $editruang = mysqli_query($conn, "SELECT * FROM ruangUjian WHERE id_ruang = '$ruang'");
        $row_edit3 = mysqli_fetch_array($editruang);

        if(isset($_POST['Ubah'])) //mengecek apakah tombol simpan sudah dipilih
        //klik atau belum
        { 
            $mhs_NPM = $_POST['npmMHS'];
            $id_ruang = $_POST['ruangID'];
            $tanggal_ujian = $_POST['TGLUJIAN'];
            $waktu_ujian = $_POST['waktu'];

            $foto = $_FILES['Dokumen']['name'];
            $dokumen_tmp = $_FILES['Dokumen']['tmp_name'];
            // move_uploaded_file($dokumen_tmp,'images/'.$foto);
            $typefile = pathinfo($foto, PATHINFO_EXTENSION); //mengambil tipe/ekstensi
             //file yang diunggah
            $ukuranfile = $_FILES["Dokumen"]["size"]; //mengambil ukuran file yang diunggah
            $path="foto/".$foto; //set folder utk upload file foto_objek
            if ($ukuranfile <= 50000000) //jika ukuran file foto <= 0.5 mb lakukan prosesnya
            {
                if (($typefile=="jpg") or ($typefile=='JPG')) {
                    if (!file_exists($path)) // mengambil file file nya sudah ada pada folder atau belum
                    //ga boleh yang udh ada di dalam folder
                    { move_uploaded_file($dokumen_tmp,'foto/'.$foto); //utk upload file pdf nya        

                    mysqli_query($conn, "UPDATE ujianSkripsi SET 
                    mhs_NPM='$mhs_NPM',
                    id_ruang='$id_ruang',
                    tanggal_ujian='$tanggal_ujian', 
                    waktu_ujian='$waktu_ujian',
                    foto='$foto'
                    WHERE mhs_NPM='$NPM'"); //memasukkan data ke dalam tabel
                    header("location:inputujianskripsi.php");
                    } 
                }
            }    
        }
        // pencarian data
        if (isset($_POST["kirim"])) {
            $search = $_POST["search"];
            $query = mysqli_query($conn, "SELECT * FROM ujianSkripsi, bimbinganSkripsi, ruangUjian
            where bimbinganSkripsi.mhs_NPM = ujianSkripsi.mhs_NPM AND ruangUjian.id_ruang = ujianSkripsi.id_ruang
            AND ujianSkripsi.mhs_NPM LIKE '%".$search."%'");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM ujianSkripsi, bimbinganSkripsi, ruangUjian
            where bimbinganSkripsi.mhs_NPM = ujianSkripsi.mhs_NPM AND ruangUjian.id_ruang = ujianSkripsi.id_ruang");
        }
        // end pencarian data
        $data = mysqli_query($conn, "select * from bimbinganSkripsi");
        $dataR = mysqli_query($conn, "select * from ruangUjian");
        
    ?>
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <form method="POST" enctype="multipart/form-data"> <!-- harus pakai si enctype kalau ga upload file ga berfungsi -->
        <div class="row mb-3 mt-5">
            <label for="npmMHS" class="col-sm-2 col-form-label">NPM Mahasiswa dan dosen Pembimbing</label>
            <div class="col-sm-10">
                <select class="form-control" id="npmMHS" name="npmMHS" placeholder="Nomor Pokok Mahasiswa dan Dosen Pembimbing">
                    <option>
                        <?php echo $row_edit['mhs_NPM']?>
                        <?php echo $row_edit2["dosen_NIDN"]?>
                    </option>
                    <?php while ($row = mysqli_fetch_array($data))
                    { ?>
                        <option value="<?php echo $row["mhs_NPM"]?>">
                            <?php echo $row["mhs_NPM"]?>
                            <?php echo $row["dosen_NIDN"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5">
            <label for="ruangID" class="col-sm-2 col-form-label">Ruang Ujian</label>
            <div class="col-sm-10">                
                <select class="form-control" id="ruangID" name="ruangID" placeholder="Isikan Ruang ID">
                    <option>
                        <?php echo $row_edit['id_ruang']?>
                        <?php echo $row_edit3["nama_ruang"]?>
                    </option>
                    <?php while ($row = mysqli_fetch_array($dataR))
                    { ?>
                        <option value="<?php echo $row["id_ruang"]?>">
                            <?php echo $row["id_ruang"]?>
                            <?php echo $row["nama_ruang"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="TGLUJIAN" class="col-sm-2 col-form-label">Tanggal Ujian</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="TGLUJIAN" name="TGLUJIAN" placeholder="Isikan Tanggal Ujian"
                value="<?php echo $row_edit["tanggal_ujian"]?>">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="waktu" class="col-sm-2 col-form-label">Waktu Ujian</label>
            <div class="col-sm-10">
                <input type="time" class="form-control" id="waktu" name="waktu" placeholder="Tulis Waktu Ujian"
                value="<?php echo $row_edit["waktu_ujian"]?>">
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="Dokumen" class="col-sm-2 col-form-label">Unggah Dokumen</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="Dokumen" name="Dokumen"
                value="<?php echo $row_edit["foto"]?>">
                <p class="help-block">Unggah file dokumen</p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-2"></div>
            <div class="col-10">
                <input type="submit" class="btn btn-success" value="Ubah" name="Ubah">
                <a href="inputujianskripsi.php" class="btn btn-danger">Batal</a>
            </div> <!-- div penutup class col-10 -->
        </div> <!-- div penutup class form group -->
    </form>
    <div class="1"></div>
    </div> <!-- div penutup class row -->

    <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="jumbotron mt-5 mb-3">
            <h1 class="display-5">Daftar Ujian Skripsi</h1>
    </div>
    
    <!-- form pencarian data -->
    <form method="POST">
        <div class="form-group row mt-5 mb-3">
            <label for="seacrh" class="col-sm-2">Cari NPM Mahasiswa</label>
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search"
                value="<?php if(isset($_POST["search"]))
                {echo $_POST["search"];}?>" placeholder="Cari NPM Mahasiswa">
            </div>
            <input type="submit" name="kirim" value="Cari" class="col-sm-1 btn btn-primary">
        </div>
    </form>
    <!-- end pencarian data -->

    <table class="table table-striped table-success table-hover">
        <tr class="info"> <!-- membuat judul -->
            <th>NPM</th>
            <th>NIDN Dosen</th>
            <th>ID Ruang</th>
            <th>Nama Ruang Ujian</th>
            <th>Tanggal Ujian</th>
            <th>Waktu Ujian</th>
            <th>Foto Skripsi</th>
            <th colspan="2" style="text-align: center;">AKSI</th>
        </tr>
        
        <?php { ?>
            <?php while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> <!-- menampilkan data dari tabel kategori -->
                        <td><?php echo $row['mhs_NPM']; ?> </td>
                        <td><?php echo $row['dosen_NIDN']; ?> </td>
                        <td><?php echo $row['id_ruang']; ?> </td>
                        <td><?php echo $row['nama_ruang']; ?> </td>
                        <td><?php echo $row['tanggal_ujian']; ?> </td>
                        <td><?php echo $row['waktu_ujian']; ?> </td>
                        <td><?php if ($row['foto']=="") {
                            echo "<img src='images/images.jpg' width='88'/>";
                        }else{ ?>
                                <img src="foto/<?php echo $row['foto'] ?>"
                                 width="88" class="img-responsive"/>
                            <?php }  ?> 
                        </td>
                        <td>
                            <a href="#" class="btn btn-success" title="EDIT">
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
                            <a href="#" class="btn btn-danger" title="HAPUS">
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