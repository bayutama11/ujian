<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="assets/gambar/logosmk.png">
  <title>LOGIN UJIAN ONLINE</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style>
body{
  background-image: url('assets/gambar/bg5.jpg');
}

  </style>

</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-4">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-5 mt-5 mb-5">
                  <div class="text-center">
                  <img class="mb-4" src="assets/gambar/logosmk.png" alt="" width="180" height="180">
                    <h1>UJIAN ONLINE</h1>
                    <h6 class="h4 text-gray-900 mb-4">SMKN 1 Kabupaten Tangerang</h6>

                    <?php 
                    
                    session_start();
                    if(isset($_SESSION['pesan_daftar'])) { ?>

                    <div class="alert alert-success">
                      <?= $_SESSION['pesan_daftar'] ?>
                    </div>

                    <?php } 
                    
                    if(isset($_SESSION['masuk_error'])) { ?>

                      <div class="alert alert-danger">
                        <?= $_SESSION['masuk_error'] ?>
                      </div>
  
                      <?php } ?>

                      <?php 
                    
                    if(isset($_SESSION['keluar_berhasil'])) { ?>

                      <div class="alert alert-success">
                        <?= $_SESSION['keluar_berhasil'] ?>
                      </div>
  
                      <?php } ?>
                    

                  </div>
                  <form class="user" action="atur_masuk.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control" aria-describedby="usernameHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password" maxlength="10"/>
                    </div>

                    <button type="submit" name="btn_masuk" value="masuk" href="" class="btn btn-primary btn-block">
                      Masuk
                    </button>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="daftar.php">Belum punya akun untuk ujian online? Klik disini.</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php session_destroy() ?>
