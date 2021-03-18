<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="assets/gambar/logosmk.png">
  <title>Registrasi Ujian Online</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    body {
      background-image: url('assets/gambar/bg5.jpg');
    }
  </style>

</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-8">

        <div class="card o-hidden border-0 shadow-lg my-1">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">

                    <h1>BUAT AKUN BARU</h1>
                    <hr><br>

                    <?php

                    session_start();
                    if (isset($_SESSION['error_regis'])) { ?>

                      <div class="alert alert-danger">
                        <?= $_SESSION['error_regis'] ?>
                      </div>

                    <?php } ?>

                  </div>
                  <form class="user" action="atur_daftar.php" method="POST">
                    <div class="form-group row">
                    <div class="col-md-6">
                      <label for="nis">NIS</label>
                      <input type="number" name="nis" class="form-control" id="nis" placeholder="Ketikkan NIS Anda">
                    </div>
                    <div class="col-md-6">
                      <label for="nama">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" id="nama" onkeydown="preventNumberInput(event)" onkeyup="preventNumberInput(event)" placeholder="Ketikkan nama lengkap Anda">
                    </div>
                    </div>
                    <hr>

                    <div class="form-group">
                      <label for="kelas">Kelas dan Jurusan</label>
                      <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Ketikkan kelas dan jurusan Anda">
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="jeniskelamin">Jenis Kelamin</label>
                        <div class="form-check">
                          <input type="radio" name="jeniskelamin" value="Laki-Laki" class="form-check-input" id="laki">
                          <label for="laki" class="form-check-label">Laki-Laki</label>
                        </div>

                        <div class="form-check">
                          <input type="radio" name="jeniskelamin" value="Perempuan" class="form-check-input" id="perempuan">
                          <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="number" name="telepon" class="form-control" id="telepon" placeholder="Ketikkan No. Telepon Anda">
                      </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder=" Ketikkan Username Anda">
                      </div>

                      <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Ketikkan Password Anda" maxlength="10"/>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="konfirmasi">Konfirmasi Password</label>
                      <input type="password" name="konfirmasi" class="form-control" id="password" placeholder="Ulangi password untuk mengkonfirmasi password Anda" maxlength="10"/>
                    </div>

                    <button name="btn_daftar" value="simpan" class="btn btn-primary btn-block">
                      Daftar
                    </button>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="medium" href="masuk.php">Sudah punya akun? Silahkan Login.</a>
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

  <script>
    function preventNumberInput(e) {
      var keyCode = (e.keyCode ? e.keyCode : e.which);
      if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107) {
        e.preventDefault();
      }
    }

    $(document).ready(function() {
      $('#text_field').keypress(function(e) {
        preventNumberInput(e);
      });
    })
  </script>

</body>

</html>

<?php session_destroy() ?>