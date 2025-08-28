<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      border-radius: 20px;
      overflow: hidden;
    }
    .login-card .card-body {
      padding: 2rem;
    }
    .brand {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0d6efd;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg login-card">
        <div class="card-body">
          <div class="text-center mb-4">
            <div class="brand">Form Login Keuangan</div>
            <p class="text-muted">Masuk akun yang sudah terdaftar.</p>
          </div>

          <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
          <?php endif; ?>

          <form method="post" action="<?= site_url('auth/login'); ?>">

            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash(); ?>" />
            

            <div class="mb-3">
              <label class="form-label">Username</label>
              <input name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button class="btn btn-primary w-100 mt-2">Login</button>
          </form>

          <hr>
          <div class="text-center">
            <small class="text-muted">
              Default admin: <strong>admin</strong> / <strong>TerangBulanKeju2025</strong>
            </small>
          </div>
        </div>
      </div>
      <p class="mt-3 text-center text-light small">© 2025 CI3 Starter Project — Latihan PKL</p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
