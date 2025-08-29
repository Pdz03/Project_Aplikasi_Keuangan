<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Dashboard - CI Keuangan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
	<style>
		:root {
			--primary-gradient: linear-gradient(135deg, #2fe38fff 0%, #333539ff 100%);
			--success-gradient: linear-gradient(135deg, #2ecc71, #27ae60);
			--danger-gradient: linear-gradient(135deg, #e74c3c, #c0392b);
			--info-gradient: linear-gradient(135deg, #3498db, #2980b9);
			--secondary-gradient: linear-gradient(135deg, #7f7fd5, #86a8e7, #91eae4);
			--dark-color: #2c3e50;
			--light-bg: #f8f9fa;
		}

		body {
			background: var(--light-bg);
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			color: #333;
		}

		.navbar-brand {
			font-weight: 700;
			color: #ffffff !important;
			/* Tambahan warna putih agar lebih jelas */
			text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.5);
			/* Tambahkan efek bayangan biar lebih tebal */
		}


		.dashboard-header {
			background: var(--primary-gradient);
			color: white;
			padding: 2rem 0;
			margin-bottom: 2rem;
			border-radius: 0 0 20px 20px;
		}

		.stat-card {
			background: white;
			border-radius: 16px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
			padding: 1.5rem;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			height: 100%;
			border: none;
			position: relative;
			overflow: hidden;
		}

		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 5px;
			height: 100%;
		}

		.stat-card.income::before {
			background: var(--success-gradient);
		}

		.stat-card.expense::before {
			background: var(--danger-gradient);
		}

		.stat-card.balance::before {
			background: var(--primary-gradient);
		}

		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
		}

		.stat-icon {
			width: 60px;
			height: 60px;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 1rem;
			font-size: 1.5rem;
		}

		.stat-icon.income {
			background: rgba(46, 204, 113, 0.15);
			color: #27ae60;
		}

		.stat-icon.expense {
			background: rgba(231, 76, 60, 0.15);
			color: #c0392b;
		}

		.stat-icon.balance {
			background: rgba(75, 108, 183, 0.15);
			color: #182848;
		}

		.stat-value {
			font-size: 1.8rem;
			font-weight: 700;
			margin: 0.5rem 0;
		}

		.stat-label {
			color: #6c757d;
			font-size: 0.9rem;
			text-transform: uppercase;
			letter-spacing: 1px;
			font-weight: 600;
		}

		.btn-action {
			border-radius: 12px;
			padding: 0.75rem 1.5rem;
			font-weight: 600;
			transition: all 0.3s ease;
			border: none;
		}

		.btn-primary {
			background: var(--primary-gradient);
		}

		.btn-success {
			background: var(--success-gradient);
		}

		.btn-outline-secondary {
			border: 2px solid #7f7fd5;
			color: #7f7fd5;
		}

		.btn-action:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
		}

		.chart-container {
			background: white;
			border-radius: 16px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
			padding: 1.5rem;
			margin-top: 2rem;
		}

		.chart-title {
			font-weight: 600;
			margin-bottom: 1.5rem;
			color: var(--dark-color);
			display: flex;
			align-items: center;
		}

		footer {
			background: white;
			padding: 1.5rem 0;
			margin-top: 3rem;
			border-top: 1px solid rgba(0, 0, 0, 0.1);
			font-size: 0.9rem;
		}

		.user-welcome {
			background: rgba(255, 255, 255, 0.2);
			padding: 0.5rem 1rem;
			border-radius: 20px;
			backdrop-filter: blur(10px);
		}

		@media (max-width: 768px) {
			.stat-value {
				font-size: 1.5rem;
			}

			.btn-action {
				padding: 0.6rem 1rem;
				font-size: 0.9rem;
			}

			.dashboard-header {
				padding: 1.5rem 0;
			}
		}
	</style>
</head>

<body>

	<!-- Dashboard Header -->
	<div class="dashboard-header">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
				<div class="container">
					<a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">
						<i class="fas fa-wallet me-2"></i>Keuangan Digital
					</a>
					<div class="ms-auto d-flex align-items-center">
						<span class="user-welcome me-3">
							Halo, <strong><?= $this->session->userdata('username'); ?></strong>
						</span>
						<a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">
							<i class="fas fa-sign-out-alt"></i> Logout
						</a>
					</div>
				</div>
			</nav>

			<div class="d-flex justify-content-between align-items-center mt-4">
				<h1 class="fw-bold"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
				<div class="d-flex gap-2">
					<a href="<?= site_url('transaksi'); ?>" class="btn btn-light btn-action">
						<i class="bi bi-list-ul me-1"></i> Daftar Transaksi
					</a>
					<a href="<?= site_url('laporan'); ?>" class="btn btn-light btn-action">
						<i class="bi bi-file-earmark-text me-1"></i> Laporan
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="container">
		<!-- Summary Cards -->
		<div class="row g-4">
			<div class="col-md-4">
				<div class="stat-card income">
					<div class="stat-icon income">
						<i class="bi bi-arrow-down-circle"></i>
					</div>
					<div class="stat-label">Total Pemasukan (Bulan Ini)</div>
					<div class="stat-value text-success">Rp <?= number_format($summary['pemasukan'] ?? 0, 0, ',', '.'); ?></div>
					<div class="text-muted mt-2">
						<i class="bi bi-calendar-check me-1"></i> Periode: <?= date('F Y'); ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="stat-card expense">
					<div class="stat-icon expense">
						<i class="bi bi-arrow-up-circle"></i>
					</div>
					<div class="stat-label">Total Pengeluaran (Bulan Ini)</div>
					<div class="stat-value text-danger">Rp <?= number_format($summary['pengeluaran'] ?? 0, 0, ',', '.'); ?></div>
					<div class="text-muted mt-2">
						<i class="bi bi-calendar-check me-1"></i> Periode: <?= date('F Y'); ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="stat-card balance">
					<div class="stat-icon balance">
						<i class="bi bi-wallet2"></i>
					</div>
					<div class="stat-label">Saldo Saat Ini</div>
					<div class="stat-value text-primary">Rp <?= number_format(($summary['pemasukan'] ?? 0) - ($summary['pengeluaran'] ?? 0), 0, ',', '.'); ?></div>
					<div class="text-muted mt-2">
						<i class="bi bi-arrow-left-right me-1"></i> Netto: <?= number_format(($summary['pemasukan'] ?? 0) - ($summary['pengeluaran'] ?? 0), 0, ',', '.'); ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Chart Section -->
		<div class="chart-container">
			<h4 class="chart-title"><i class="bi bi-graph-up-arrow me-2"></i>Grafik Pemasukan & Pengeluaran</h4>
			<canvas id="financeChart" height="100"></canvas>
		</div>
	</div>

	<!-- Footer -->
	<footer class="text-center">
		<div class="container">
			<p class="mb-0">© <?= date('Y'); ?> CI Keuangan — Dibuat untuk latihan PKL</p>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const ctx = document.getElementById('financeChart').getContext('2d');

			// Create gradient for chart bars
			const incomeGradient = ctx.createLinearGradient(0, 0, 0, 400);
			incomeGradient.addColorStop(0, 'rgba(46, 204, 113, 0.8)');
			incomeGradient.addColorStop(1, 'rgba(39, 174, 96, 0.4)');

			const expenseGradient = ctx.createLinearGradient(0, 0, 0, 400);
			expenseGradient.addColorStop(0, 'rgba(231, 76, 60, 0.8)');
			expenseGradient.addColorStop(1, 'rgba(192, 57, 43, 0.4)');

			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Pemasukan', 'Pengeluaran'],
					datasets: [{
						label: 'Jumlah (Rp)',
						data: [<?= $summary['pemasukan'] ?? 0; ?>, <?= $summary['pengeluaran'] ?? 0; ?>],
						backgroundColor: [incomeGradient, expenseGradient],
						borderColor: ['#27ae60', '#c0392b'],
						borderWidth: 1,
						borderRadius: 8,
						barPercentage: 0.6,
					}]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									return 'Rp ' + context.raw.toLocaleString('id-ID');
								}
							}
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							grid: {
								color: 'rgba(0, 0, 0, 0.05)'
							},
							ticks: {
								callback: function(value) {
									return 'Rp ' + value.toLocaleString('id-ID');
								}
							}
						},
						x: {
							grid: {
								display: false
							}
						}
					}
				}
			});
		});
	</script>
</body>

</html>