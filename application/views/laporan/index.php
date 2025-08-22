<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Laporan Bulanan - CI Keuangan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
	<style>
		.filter-bar {
			background: #f8f9fa;
			border-radius: .75rem;
			padding: 16px 20px;
			border: 1px solid #e1e1e1;
		}

		.badge-masuk {
			background: #198754;
			font-weight: 500;
		}

		.badge-keluar {
			background: #dc3545;
			font-weight: 500;
		}

		.table thead th {
			background: #2c3e50;
			color: #fff;
		}

		.summary-box {
			background: #f8f9fa;
			border-radius: .75rem;
			padding: 16px;
			text-align: center;
		}

		.summary-box h5 {
			margin: 0;
			font-weight: bold;
		}

		.summary-box p {
			margin: 0;
			font-size: 1.2rem;
		}
	</style>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand fw-bold text-primary" href="<?= site_url('dashboard'); ?>">
				<i class="fas fa-wallet me-2"></i>Keuangan Digital
			</a>
			<div class="ms-auto d-flex align-items-center">
				<a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-danger btn-sm">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</div>
	</nav>

	<!-- Content -->
	<div class="container py-4">
		<div class="bg-white rounded-4 p-4 shadow-sm">

			<h4 class="fw-semibold mb-3">📊 Laporan Bulanan</h4>

			<!-- Filter -->
			<div class="filter-bar mb-4">
				<form method="get" class="row g-3 align-items-end">
					<div class="col-md-3">
						<label class="form-label fw-semibold">Tahun</label>
						<input type="number" name="year" class="form-control" value="<?= $year; ?>">
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Bulan</label>
						<input type="number" name="month" class="form-control" value="<?= $month; ?>" min="1" max="12">
					</div>
					<div class="col-md-6 text-end">
						<button class="btn btn-primary">
							<i class="fas fa-eye"></i> Tampilkan
						</button>

						<a href="<?= site_url('laporan/export_pdf?year=' . $year . '&month=' . $month); ?>" class="btn btn-outline-danger">
							<i class="fas fa-file-pdf"></i> Export PDF
						</a>

						<a href="<?= site_url('laporan/export_excel?year=' . $year . '&month=' . $month); ?>" class="btn btn-outline-success">
							<i class="bi bi-file-earmark-excel"></i> Export Excel
						</a>

					</div>
				</form>
			</div>
			<!-- End Filter -->

			<!-- Ringkasan -->
			<?php
			$total_masuk = 0;
			$total_keluar = 0;
			foreach ($rekap as $r) {
				if ($r->jenis == 'masuk') $total_masuk += $r->nominal;
				else $total_keluar += $r->nominal;
			}
			$saldo = $total_masuk - $total_keluar;
			?>
			<div class="row mb-4">
				<!-- Total Masuk -->
				<div class="col-md-4">
					<div class="summary-box bg-white text-success p-3 rounded shadow d-flex align-items-center">
						<div class="me-3">
							<i class="fas fa-arrow-circle-down fa-2x"></i>
						</div>
						<div>
							<h6 class="mb-1">Total Masuk</h6>
							<p class="mb-0 fw-bold">Rp <?= number_format($total_masuk, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>

				<!-- Total Keluar -->
				<div class="col-md-4">
					<div class="summary-box bg-white text-danger p-3 rounded shadow d-flex align-items-center">
						<div class="me-3">
							<i class="fas fa-arrow-circle-up fa-2x"></i>
						</div>
						<div>
							<h6 class="mb-1">Total Keluar</h6>
							<p class="mb-0 fw-bold">Rp <?= number_format($total_keluar, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>

				<!-- Saldo Akhir -->
				<div class="col-md-4">
					<div class="summary-box bg-white text-primary p-3 rounded shadow d-flex align-items-center">
						<div class="me-3">
							<i class="fas fa-wallet fa-2x"></i>
						</div>
						<div>
							<h6 class="mb-1">Saldo Akhir</h6>
							<p class="mb-0 fw-bold">Rp <?= number_format($saldo, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>
			</div>
			<!-- End Ringkasan -->


			<!-- Tabel -->
			<div class="table-responsive">
				<table class="table table-bordered table-hover align-middle">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tanggal</th>
							<th>Jenis</th>
							<th>Nominal</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($rekap)): ?>
							<?php foreach ($rekap as $r): ?>
								<tr>
									<td><?= $r->id; ?></td>
									<td><?= date('d M Y', strtotime($r->tanggal)); ?></td>
									<td>
										<?php if ($r->jenis == 'masuk'): ?>
											<span class="badge badge-masuk">Masuk</span>
										<?php else: ?>
											<span class="badge badge-keluar">Keluar</span>
										<?php endif; ?>
									</td>
									<td>Rp <?= number_format($r->nominal, 0, ',', '.'); ?></td>
									<td><?= $r->keterangan; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5" class="text-center text-muted">Tidak ada data</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<!-- End Tabel -->

		</div>
		<p class="text-center text-muted mt-4 small">&copy; <?= date('Y'); ?> CI3 Starter Project — latihan PKL</p>
	</div>
	<!-- End Content -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
