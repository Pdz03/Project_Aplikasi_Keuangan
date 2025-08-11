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
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white app-navbar shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url('dashboard'); ?>">CI Keuangan</a>
    <div class="ms-auto">
      <span class="me-3">Halo, <?= $this->session->userdata('username'); ?></span>
      <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-secondary btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row g-3">
    <div class="col-md-4">
      <div class="container-card">
        <h6>Total Pemasukan (Bulan Ini)</h6>
        <h3 class="text-success">Rp <?= number_format($summary['pemasukan'] ?? 0,0,',','.'); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="container-card">
        <h6>Total Pengeluaran (Bulan Ini)</h6>
        <h3 class="text-danger">Rp <?= number_format($summary['pengeluaran'] ?? 0,0,',','.'); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="container-card">
        <h6>Saldo</h6>
        <h3>Rp <?= number_format(($summary['pemasukan'] ?? 0)-($summary['pengeluaran'] ?? 0),0,',','.'); ?></h3>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <a href="<?= site_url('transaksi'); ?>" class="btn btn-primary">Daftar Transaksi</a>
    <a href="<?= site_url('transaksi/add'); ?>" class="btn btn-success">Tambah Transaksi</a>
    <a href="<?= site_url('laporan'); ?>" class="btn btn-outline-secondary">Laporan</a>
  </div>

  <footer class="app-footer">CI3 Starter Project — latihan PKL</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
