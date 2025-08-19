<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <div class="ms-auto">
      <span class="me-3">Halo, <?= $this->session->userdata('username'); ?></span>
      <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
     <h3 class="fw-semibold mb-0">Dashboard</h3>
     <div class="d-flex gap-2">
        <a href="<?= site_url('transaksi'); ?>" class="btn btn-primary">Daftar Transaksi</a>
        <a href="<?= site_url('transaksi/add'); ?>" class="btn btn-success">+ Tambah</a>
        <a href="<?= site_url('laporan'); ?>" class="btn btn-outline-secondary">Laporan</a>
     </div>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="p-3 bg-white rounded-4 shadow-sm">
        <small class="text-muted">Total Pemasukan (Bulan Ini)</small>
        <h4 class="mt-1 text-success">Rp <?= number_format($summary['pemasukan'] ?? 0,0,',','.'); ?></h4>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-3 bg-white rounded-4 shadow-sm">
        <small class="text-muted">Total Pengeluaran (Bulan Ini)</small>
        <h4 class="mt-1 text-danger">Rp <?= number_format($summary['pengeluaran'] ?? 0,0,',','.'); ?></h4>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-3 bg-white rounded-4 shadow-sm">
        <small class="text-muted">Saldo</small>
        <h4 class="mt-1">Rp <?= number_format(($summary['pemasukan'] ?? 0)-($summary['pengeluaran'] ?? 0),0,',','.'); ?></h4>
      </div>
    </div>
  </div>

  <p class="text-center text-muted mt-4 small">CI3 Starter Project — latihan PKL</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
