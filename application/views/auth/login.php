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
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white app-navbar shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= base_url(); ?>">CI Keuangan</a>
  </div>
</nav>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white p-4 rounded-4 shadow-sm">
        <h4 class="mb-4 text-center fw-semibold">Masuk ke Akun</h4>

        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/login'); ?>">
          <div class="mb-3">
            <label class="form-label fw-medium">Username</label>
            <input name="username" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label fw-medium">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100 mt-2">Login</button>
        </form>

        <hr>
        <small class="text-muted d-block text-center">
          Default admin: <strong>admin</strong> / <strong>TerangBulanKeju2025</strong>
        </small>
      </div>
      <p class="mt-3 text-center text-muted">CI3 Starter Project — latihan PKL</p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
