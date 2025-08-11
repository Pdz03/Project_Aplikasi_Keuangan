<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white app-navbar shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>">CI Keuangan</a>
  </div>
</nav>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="container-card">
        <h4 class="mb-3 text-center">Masuk ke Akun</h4>

        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/login'); ?>">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Login</button>
        </form>

        <hr>
        <small class="text-muted">Default admin: <strong>admin</strong> / <strong>TerangBulanKeju2025</strong></small>
      </div>
      <footer class="app-footer">CI3 Starter Project — latihan PKL</footer>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
