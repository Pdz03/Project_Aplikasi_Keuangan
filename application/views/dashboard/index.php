<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Dashboard - CI Keuangan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand fw-bold text-primary" href="<?= site_url('dashboard'); ?>">
				<i class="fas fa-wallet me-2"></i>Keuangan Digital
			</a>
			<div class="ms-auto d-flex align-items-center">
				<span class="me-3 text-dark">
					Halo, <strong><?= $this->session->userdata('username'); ?></strong>
				</span>
				<a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</div>
	</nav>


	<!-- Content -->
	<div class="container py-5">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h3 class="fw-semibold mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h3>
			<div class="d-flex gap-2">
				<a href="<?= site_url('transaksi'); ?>" class="btn btn-primary"><i class="bi bi-list-ul me-1"></i> Daftar</a>
				<a href="<?= site_url('transaksi/add'); ?>" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i> Tambah</a>
				<a href="<?= site_url('laporan'); ?>" class="btn btn-outline-secondary"><i class="bi bi-file-earmark-text me-1"></i> Laporan</a>
			</div>
		</div>

		<div class="row g-4">
			<div class="col-md-4">
				<div class="p-4 bg-white rounded-4 shadow-sm d-flex align-items-center">
					<div class="me-3 text-success"><i class="bi bi-arrow-down-circle fs-2"></i></div>
					<div>
						<small class="text-muted">Total Pemasukan (Bulan Ini)</small>
						<h4 class="mt-1 text-success">Rp <?= number_format($summary['pemasukan'] ?? 0, 0, ',', '.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-4 bg-white rounded-4 shadow-sm d-flex align-items-center">
					<div class="me-3 text-danger"><i class="bi bi-arrow-up-circle fs-2"></i></div>
					<div>
						<small class="text-muted">Total Pengeluaran (Bulan Ini)</small>
						<h4 class="mt-1 text-danger">Rp <?= number_format($summary['pengeluaran'] ?? 0, 0, ',', '.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="p-4 bg-white rounded-4 shadow-sm d-flex align-items-center">
					<div class="me-3 text-primary"><i class="bi bi-wallet2 fs-2"></i></div>
					<div>
						<small class="text-muted">Saldo</small>
						<h4 class="mt-1">Rp <?= number_format(($summary['pemasukan'] ?? 0) - ($summary['pengeluaran'] ?? 0), 0, ',', '.'); ?></h4>
					</div>
				</div>
			</div>
		</div>

		<!-- Optional: Chart -->
		<div class="mt-5">
			<h5><i class="bi bi-graph-up-arrow me-2"></i>Grafik Pemasukan & Pengeluaran</h5>
			<canvas id="financeChart" height="100"></canvas>
		</div>

	</div>

	<!-- Footer -->
	<footer class="text-center py-3 mt-5 bg-white border-top small text-muted">
		© <?= date('Y'); ?> CI Keuangan — Dibuat untuk latihan PKL
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		const ctx = document.getElementById('financeChart').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Pemasukan', 'Pengeluaran'],
				datasets: [{
					label: 'Jumlah (Rp)',
					data: [<?= $summary['pemasukan'] ?? 0; ?>, <?= $summary['pengeluaran'] ?? 0; ?>],
					backgroundColor: ['#198754', '#dc3545']
				}]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						display: false
					}
				}
			}
		});
	</script>
</body>

</html>
