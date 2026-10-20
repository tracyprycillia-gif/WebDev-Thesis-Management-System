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
            $dosen_NIDN = $_POST['nidnDOSEN'];

            $penasihat_FILE = $_FILES['penasihatFILE']['name'];
            $dokumen_tmp = $_FILES['penasihatFILE']['tmp_name'];
            // move_uploaded_file($dokumen_tmp,'images/'.$penasihat_FILE);
            // //tambahkan kondisi di bagian ini utk memeriksa file yg diunggah
            $typefoto = pathinfo($penasihat_FILE, PATHINFO_EXTENSION); //mengambil tipe/ekstensi
            //file yang diunggah
            $ukuranfoto = $_FILES["penasihatFILE"]["size"]; //mengambil ukuran file yang diunggah
            $path="images/".$penasihat_FILE; //set folder utk upload file foto_objek
            
            if ($ukuranfoto <= 50000000) //jika ukuran file foto <= 0.5 mb lakukan prosesnya
            {
                if (($typefoto=="jpg") or ($typefoto=='png')) {
                    if (!file_exists($path)) // mengambil file file nya sudah ada pada folder atau belum
                    //ga boleh yang udh ada di dalam folder
                    { move_uploaded_file($dokumen_tmp,'images/'.$penasihat_FILE); //utk upload file gambarnya        
                        
                        $penasihat_Ket = $_POST['penasihatKET'];
                        
                        mysqli_query($conn, "insert into penasihat values('$mhs_NPM', '$dosen_NIDN', 
                        '$penasihat_FILE', '$penasihat_Ket')"); //memasukkan data ke dalam tabel
                        header("location:inputpenasihat.php");
                    } 
                }
            }    
        }

        $query = mysqli_query($conn, "select * from penasihat,dosen,mahasiswa
        where mahasiswa.mhs_NPM = penasihat.mhs_NPM and penasihat.dosen_NIDN =
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
                <select class="form-control" id="npmMHS" name="npmMHS">
                    <option>Cari NPM Mahasiswa</option>
                    <?php while ($row = mysqli_fetch_array($datamhs))
                    { ?>
                        <option value="<?php echo $row["mhs_NPM"]?>">
                            <?php echo $row["mhs_NPM"]?>
                            <?php echo $row["mhs_Nama"]?>
                        </option>
                    <?php } ?>
                </select>
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
        <div class="row mb-3 mt-5"> 
            <label for="penasihatFILE" class="col-sm-2 col-form-label">Unggah Dokumen</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="penasihatFILE" name="penasihatFILE"
                accept="image/jpg, image/png">
                <p class="help-block">Unggah fil dokumen</p>
            </div>
        </div>
        <div class="row mb-3 mt-5"> 
            <label for="penasihatKET" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="penasihatKET" name="penasihatKET">
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
            <h1 class="display-5">Daftar Penasihat Akademik</h1>
    </div>

    <table class="table table-striped table-success table-hover">
        <tr class="info"> <!-- membuat judul -->
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>Dokumen</th>
            <th>Keterangan</th>
        </tr>
        
        <?php { ?>
            <?php while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> <!-- menampilkan data dari tabel kategori -->
                        <td><?php echo $row['mhs_NPM']; ?> </td>
                        <td><?php echo $row['mhs_Nama']; ?> </td>
                        <td><?php echo $row['dosen_NIDN']; ?> </td>
                        <td><?php echo $row['dosen_Nama']; ?> </td>
                        <td><?php if ($row['penasihat_FILE']=="") {
                            echo "<img src='images/images.jpg' width='88'/>";
                        }else{ ?>
                                <img src="images/<?php echo $row['penasihat_FILE'] ?>"
                                 width="88" class="img-responsive"/>
                            <?php }  ?> 
                        </td>
                        <td><?php echo $row['penasihat_Ket']; ?> </td>
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