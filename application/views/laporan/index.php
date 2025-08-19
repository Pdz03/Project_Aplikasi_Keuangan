<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Laporan Bulanan - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .filter-bar  { background:#f8f9fa; border-radius:.5rem; padding:12px 16px; }
    .badge-masuk { background:#198754; font-weight:500; }
    .badge-keluar{ background:#dc3545; font-weight:500; }
    .table-hover tbody tr:hover { background:#f2f9ff; }
  </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-secondary btn-sm ms-auto">Logout</a>
  </div>
</nav>

<div class="container py-4">
  <div class="bg-white rounded-4 p-4 shadow-sm">

    <h4 class="fw-semibold mb-3">Laporan Bulanan</h4>

    <!-- FILTER (tanpa card / model toolbar) -->
    <div class="filter-bar mb-3">
      <form method="get" class="row g-2 align-items-end">
        <div class="col-md-3">
          <label class="form-label fw-semibold mb-1">Tahun</label>
          <input type="number" name="year" class="form-control" value="<?= $year; ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw-semibold mb-1">Bulan</label>
          <input type="number" name="month" class="form-control" value="<?= $month; ?>">
        </div>
        <div class="col-md-6 text-end">
          <button class="btn btn-primary mt-4 me-1">Tampilkan</button>
          <a href="<?= site_url('laporan/export_pdf?year='.$year.'&month='.$month); ?>" class="btn btn-outline-secondary mt-4">PDF</a>
          <a href="<?= site_url('laporan/export_excel?year='.$year.'&month='.$month); ?>" class="btn btn-outline-secondary mt-4">Excel</a>
        </div>
      </form>
    </div>
    <!-- END FILTER -->

    <!-- TABEL -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
        <?php if(!empty($rekap)): ?>
          <?php foreach($rekap as $r): ?>
            <tr>
              <td><?= $r->id; ?></td>
              <td><?= date('d M Y', strtotime($r->tanggal)); ?></td>
              <td>
                <?php if($r->jenis == 'masuk'): ?>
                  <span class="badge badge-masuk">Masuk</span>
                <?php else: ?>
                  <span class="badge badge-keluar">Keluar</span>
                <?php endif; ?>
              </td>
              <td>Rp <?= number_format($r->nominal,0,',','.'); ?></td>
              <td><?= $r->keterangan; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    <!-- END TABEL -->

    <div class="text-muted small mt-2">
      <em>TODO : export PDF / Excel, filter lanjutan & pagination.</em>
    </div>

  </div>
  <p class="text-center text-muted mt-4 small">CI3 Starter Project — latihan PKL</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
