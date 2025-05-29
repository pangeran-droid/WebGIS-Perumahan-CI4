<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIGABAR | <?= $judul ?></title>

  <link rel="icon" type="image/png" href="<?= base_url('logo/logo.png') ?>">
  <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url('/') ?>" class="h1"><b>SIG</b>ABAR</a>
    </div>
    <div class="card-body">
  <p class="login-box-msg">Buat akun baru</p>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close float-right" data-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('errors')): ?>
    <?php foreach ((array)session()->getFlashdata('errors') as $error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error ?>
        <button type="button" class="btn-close float-right" data-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <form action="<?= base_url('Auth/saveRegister') ?>" method="post">
    <div class="input-group mb-3">
      <input type="text" name="username" class="form-control <?= session()->getFlashdata('errors')['username'] ?? false ? 'is-invalid' : '' ?>" placeholder="Username" value="<?= old('username') ?>">
      <div class="input-group-append">
        <div class="input-group-text"><span class="fas fa-user"></span></div>
      </div>
    </div>
    <?php if (session()->getFlashdata('errors')['username'] ?? false): ?>
      <div class="text-danger small mb-2"><?= session()->getFlashdata('errors')['username'] ?></div>
    <?php endif; ?>

    <div class="input-group mb-3">
      <input type="email" name="email" class="form-control <?= session()->getFlashdata('errors')['email'] ?? false ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= old('email') ?>">
      <div class="input-group-append">
        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
      </div>
    </div>
    <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
      <div class="text-danger small mb-2"><?= session()->getFlashdata('errors')['email'] ?></div>
    <?php endif; ?>

    <div class="input-group mb-3">
      <input type="password" name="password" class="form-control <?= session()->getFlashdata('errors')['password'] ?? false ? 'is-invalid' : '' ?>" placeholder="Password">
      <div class="input-group-append">
        <div class="input-group-text"><span class="fas fa-lock"></span></div>
      </div>
    </div>
    <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
      <div class="text-danger small mb-2"><?= session()->getFlashdata('errors')['password'] ?></div>
    <?php endif; ?>

    <div class="row">
      <div class="col-8">
        <a href="<?= base_url('Auth/Login') ?>">Sudah punya akun?</a>
      </div>
      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
      </div>
    </div>
  </form>
</div>
  </div>
</div>

<script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js') ?>"></script>
<script>
  $(document).ready(function () {
    // Menghilangkan alert setelah 3 detik (kecuali alert-important jika ada)
    $(".alert").not(".alert-important").delay(3000).fadeOut(500);

    // Redirect ke halaman login setelah sukses register (jika ada flashdata 'success')
    <?php if (session()->getFlashdata('success')): ?>
      setTimeout(function () {
        window.location.href = "<?= base_url('Auth/Login') ?>";
      }, 3000);
    <?php endif; ?>
  });
</script>

</body>
</html>
