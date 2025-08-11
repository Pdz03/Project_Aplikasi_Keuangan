<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white app-navbar shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <div class="ms-auto">
      <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-secondary btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="container-card">
    <h4><?php echo isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi</h4>
    <?php if(!empty($error)): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

    <form method="post" action="">
      <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= isset($transaksi)?$transaksi->tanggal:date('Y-m-d'); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Jenis</label>
        <select name="jenis" class="form-select" required>
          <option value="masuk" <?= (isset($transaksi) && $transaksi->jenis=='masuk')?'selected':''; ?>>Masuk</option>
          <option value="keluar" <?= (isset($transaksi) && $transaksi->jenis=='keluar')?'selected':''; ?>>Keluar</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Nominal</label>
        <input type="number" name="nominal" class="form-control" value="<?= isset($transaksi)?$transaksi->nominal:''; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= isset($transaksi)?$transaksi->keterangan:''; ?></textarea>
      </div>
      <button class="btn btn-primary">Simpan</button>
      <a href="<?= site_url('transaksi'); ?>" class="btn btn-secondary">Batal</a>
    </form>
  </div>

  <footer class="app-footer">CI3 Starter Project — latihan PKL</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
