<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="assets/gambar/logosmk.png">
  <title>Ujian Online SMKN 1 Kabupaten Tengerang</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/js/sweetalert2.min.css">
  <script src="assets/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion text-dark">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3">
        <div class="sidebar-brand-icon rotate-n-0">
        </div>
        <h5><b>Ujian Online</b></h5>
      </a>

      <div class="h1 sidebar-heading text-center">
        <?= $_SESSION['level'] ?>
      </div>

      <?php if ($_SESSION['level'] == 'siswa') { ?>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-home"></i>
            <span>HALAMAN UTAMA</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=ujian">
            <i class="fas fa-fw fa-pencil-alt"></i>
            <span>UJIAN</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=nilai">
            <i class="fas fa-star"></i>
            <span>NILAI UJIAN</span></a>
        </li>
      <?php } ?>

      <!-- Jika admin -->
      <?php if ($_SESSION['level'] == 'guru') { ?>

        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-home"></i>
            <span>HALAMAN UTAMA</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=data-siswa">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>DATA SISWA</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=ujian">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>UJIAN</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" aria-expanded="false" data-target="#myModal">
            <i class="fas fa-list"></i>
            <span>LAPORAN</span></a>
        </li>

      <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= $base_url ?>/atur_keluar.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>KELUAR</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark bg-white topbar mb-4 static-top shadow text-dark">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama']  ?></span>
                <img class="img-profile rounded-circle" src="assets/gambar/userlogo.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <div class="dropdown"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="modal" tabindex="-1" role="dialog" id="myModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                Laporan Ujian
              </div>
              <div class="modal-body">
                <form method="POST" action="laporan.php">
                  <div class="form-group">
                    <label>Pilih Ujian</label>
                    <select name="id_ujian" class="form-control">
                      <?php
                        $sql = $koneksi->query("SELECT * FROM ujian WHERE id_user = $_SESSION[id]");
                        while ($data = $sql->fetch_assoc()):
                      ?>
                      <option value="<?= $data['id']; ?>"><?= $data['mapel']; ?></option>
                        <?php endwhile; ?>
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lihat</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
              </form>
            </div>
          </div>
        </div>