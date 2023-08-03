<?php
include('koneksi.php');
 
if(isset($_SESSION['login_user'])){
header("location: about.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistem Pakar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
          
          
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="homeadmin.php"><button type="button" class="btn btn-primary btn-block">BERANDA</button></a></p>
      <p><a href="hamadanpenyakit.php"><button type="button" class="btn btn-primary btn-block active">HAMA dan PENYAKIT</button></a></p>
      <p><a href="gejala.php"><button type="button" class="btn btn-primary btn-block">GEJALA</button></a></p>
      <p><a href="basispengetahuan.php"><button type="button" class="btn btn-primary btn-block">BASIS PENGETAHUAN</button></a></p>
      <br><br><br><br><br><br><br><br><br><br>
      <p><a href="logout.php"><button type="button" class="btn btn-primary btn-block" id="myBtn">LOGOUT</button></a></p>
    </div>
    <div class="col-sm-8 text-left"> 
    <?php
                       $tampil = "SELECT * FROM penyakit where idpenyakit='".$_GET['id']."'";
                       $sql = mysqli_query ($konek_db,$tampil);
                       while($data = mysqli_fetch_array ($sql))
                    {
                       
                ?>
      <h2 class="text-center">Edit Gambar Penyakit<b> <?= $data['namapenyakit']; ?></h2>

      <?php

}
?>
    <form enctype="multipart/form-data" method="post" >


                           
      <div class="form-group"  method="POST">
            <br><label class="control-label col-sm-2">Gambar :</label><br>
          <div class="col-sm-10">
                <?php
                       $tampil = "SELECT * FROM penyakit where idpenyakit='".$_GET['id']."'";
                       $sql = mysqli_query ($konek_db,$tampil);
                       while($data = mysqli_fetch_array ($sql))
                    {
                       echo '<img src="./gambar_penyakit/'. $data['gambar'] .'" width="320px" height="320px"></img><br>';
                    }
                ?>
         </div>  
        </div>

            <div class="form-group has-feedback">
        <label class="control-label col-sm-2"  for="nama">Upload/edit Gambar Disini :</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" name="gambar">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors" role="alert"></div>
        </div>
      </div>



     <button type="submit" name ="submit" class="btn btn-primary">Simpan</button>


                                    <?php   
                    if(isset($_POST['submit'])){

                      $id = $_GET['id'];
                      $namapenyakit = $_POST['namapenyakit'];
                      $jenistanaman = $_POST['jenistanaman'];
                      $solusi = $_POST['solusi']; 

   
// Baca lokasi file sementar dan nama file dari form (fupload)
$lokasi_file = $_FILES['gambar']['tmp_name'];
$gambar   = $_FILES['gambar']['name'];
// Tentukan folder untuk menyimpan file
$folder = "gambar_penyakit/$gambar";
// tanggal sekarang

// Apabila file berhasil di upload
if (move_uploaded_file($lokasi_file,"$folder")){
  echo "Nama File : <b>$gambar</b> sukses di upload";
  
              


                    $query="update penyakit SET gambar='".$gambar."' WHERE idpenyakit='$id'";
                   $result=mysqli_query($konek_db, $query);
                  header("location:./hamadanpenyakit.php");



                          }
                    }
                ?>



        </form><br>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Sistem Pakar</p>
</footer>

</body>
</html>
