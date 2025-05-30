<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SIGABAR | <?= esc($judul) ?></title> <!-- esc() untuk keamanan XSS -->

  <link rel="icon" type="image/png" href="<?= base_url('logo/logo.png') ?>" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.min.css') ?>" />
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" />
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-indigo navbar-dark">
    <div class="container">
      <a href="<?= base_url('Home') ?>" class="navbar-brand">
        <img src="<?= base_url('logo/logo.png') ?>" alt="Logo" class="me-2" height="45" />
      </a>
      <h5><b><?= esc($web['nama_web']) ?></b></h5>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
              aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a href="<?= base_url('Home') ?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li>  
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content">
      <div class="row">
        <!-- Konten dinamis -->
        <?= $page ? view($page) : '' ?>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Bisa dikosongkan atau isi dengan widget kontrol -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>&copy; <?= date('Y') ?> <a href="<?= base_url() ?>"><?= esc($web['nama_web']) ?></a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>
