<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Daftar Transaksi - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    /* Hover effect untuk baris tabel */
    .table-hover tbody tr:hover {
      background-color: #f1f8ff;
    }

    /* Badge lebih stylish */
    .badge-masuk {
      background-color: #198754;
      font-weight: 500;
    }
    .badge-keluar {
      background-color: #dc3545;
      font-weight: 500;
    }

    /* Tombol aksi lebih rapih */
    .action-btns .btn {
      margin-right: 4px;
    }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm ms-auto">Logout</a>
  </div>
</nav>

<div class="container py-4">
  <div class="bg-white rounded-4 shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0 fw-semibold">Daftar Transaksi</h4>
      <div class="d-flex gap-2">
        <a href="<?= site_url('transaksi/add'); ?>" class="btn btn-success btn-sm">
          <i class="bi bi-plus-lg"></i> Tambah
        </a>
        <a href="<?= site_url('dashboard'); ?>" class="btn btn-secondary btn-sm">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if(!empty($transaksi)): ?>
          <?php foreach($transaksi as $t): ?>
            <tr>
              <td><?= $t->id; ?></td>
              <td><?= date('d M Y', strtotime($t->tanggal)); ?></td>
              <td>
                <?php if($t->jenis=='masuk'): ?>
                  <span class="badge badge-masuk">Masuk</span>
                <?php else: ?>
                  <span class="badge badge-keluar">Keluar</span>
                <?php endif; ?>
              </td>
              <td>Rp <?= number_format($t->nominal,0,',','.'); ?></td>
              <td><?= $t->keterangan; ?></td>
              <td class="text-center action-btns">
                <a href="<?= site_url('transaksi/edit/'.$t->id); ?>" class="btn btn-sm btn-primary">
                  <i class="bi bi-pencil"></i>
                </a>
                <a href="<?= site_url('transaksi/delete/'.$t->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>

  <p class="text-center text-muted mt-4 small">CI3 Starter Project — latihan PKL</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
