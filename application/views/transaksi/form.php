<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
        background: linear-gradient(135deg,#f2f4f8,#dfe4ec);
      }
      .glass-card {
        backdrop-filter: blur(8px);
        background: rgba(255,255,255,0.75);
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0,0,0,.05);
      }
  </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm mb-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">Logout</a>
  </div>
</nav>

<div class="container py-4">
  <div class="mx-auto" style="max-width:620px;">
    <div class="glass-card p-4">
      <h3 class="fw-semibold mb-4"><?= isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi</h3>

      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="form-floating mb-3">
          <input type="date" name="tanggal" class="form-control" id="tanggalInput" value="<?= isset($transaksi)?$transaksi->tanggal:date('Y-m-d'); ?>" required>
          <label for="tanggalInput">Tanggal</label>
        </div>

        <div class="form-floating mb-3">
          <select name="jenis" class="form-select" id="jenisSelect" required>
            <option value="masuk" <?= (isset($transaksi) && $transaksi->jenis=='masuk')?'selected':''; ?>>Masuk</option>
            <option value="keluar" <?= (isset($transaksi) && $transaksi->jenis=='keluar')?'selected':''; ?>>Keluar</option>
          </select>
          <label for="jenisSelect">Jenis Transaksi</label>
        </div>

        <div class="form-floating mb-3">
          <input type="number" name="nominal" class="form-control" id="nominalInput" value="<?= isset($transaksi)?$transaksi->nominal:''; ?>" required>
          <label for="nominalInput">Nominal</label>
        </div>

        <div class="form-floating mb-3">
          <textarea name="keterangan" class="form-control" id="ketInput" style="height:100px"><?= isset($transaksi)?$transaksi->keterangan:''; ?></textarea>
          <label for="ketInput">Keterangan</label>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="<?= site_url('transaksi'); ?>" class="btn btn-secondary">Batal</a>
          <button class="btn btn-primary">
            💾 Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
