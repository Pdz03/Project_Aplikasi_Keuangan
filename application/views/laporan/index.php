<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Laporan Bulanan - CI Keuangan</title>
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
    <h4>Laporan Bulanan</h4>

    <form method="get" class="row g-2 align-items-end">
      <div class="col-md-3">
        <label class="form-label">Tahun</label>
        <input type="number" name="year" class="form-control" value="<?= $year; ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Bulan</label>
        <input type="number" name="month" class="form-control" value="<?= $month; ?>">
      </div>
      <div class="col-md-6">
        <button class="btn btn-primary">Tampilkan</button>
        <a href="<?= site_url('laporan/export_pdf?year='.$year.'&month='.$month); ?>" class="btn btn-outline-secondary">Export PDF (TODO)</a>
        <a href="<?= site_url('laporan/export_excel?year='.$year.'&month='.$month); ?>" class="btn btn-outline-secondary">Export Excel (TODO)</a>
      </div>
    </form>

    <hr>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead><tr><th>Tanggal</th><th>Jenis</th><th>Nominal</th><th>Keterangan</th></tr></thead>
        <tbody>
        <?php foreach($rekap as $r): ?>
          <tr>
            <td><?= $r->tanggal; ?></td>
            <td><?= $r->jenis; ?></td>
            <td>Rp <?= number_format($r->nominal,0,',','.'); ?></td>
            <td><?= $r->keterangan; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <hr>
    <p>TODO untuk siswa: implement export PDF / Excel, filter lebih lengkap, pagination.</p>
  </div>

  <footer class="app-footer">CI3 Starter Project — latihan PKL</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
