<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Daftar Transaksi - CI Keuangan</title>
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
    <h4>Daftar Transaksi</h4>
    <div class="mb-3">
      <a href="<?= site_url('transaksi/add'); ?>" class="btn btn-success btn-sm">Tambah</a>
      <a href="<?= site_url('dashboard'); ?>" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead><tr><th>ID</th><th>Tanggal</th><th>Jenis</th><th>Nominal</th><th>Keterangan</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach($transaksi as $t): ?>
          <tr>
            <td><?= $t->id; ?></td>
            <td><?= $t->tanggal; ?></td>
            <td><?= $t->jenis; ?></td>
            <td>Rp <?= number_format($t->nominal,0,',','.'); ?></td>
            <td><?= $t->keterangan; ?></td>
            <td>
              <a href="<?= site_url('transaksi/edit/'.$t->id); ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="<?= site_url('transaksi/delete/'.$t->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer class="app-footer">CI3 Starter Project — latihan PKL</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
