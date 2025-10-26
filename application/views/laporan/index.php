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
		body {
			background: #f4f6fb;
			font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			color: #374151;
			font-size: 0.9rem;
		}

		/* Header */
		.header {
			background: linear-gradient(135deg, #6366f1, #4f46e5, #312e81);
			color: white;
			padding: 20px 0;
			border-bottom-left-radius: 1rem;
			border-bottom-right-radius: 1rem;
			box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
		}

		.header .brand {
			font-size: 1.1rem;
			font-weight: 700;
		}

		.page-title {
			font-weight: 600;
			font-size: 1.1rem;
		}

		.card-custom {
			border: none;
			border-radius: .7rem;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
			background: #fff;
			padding: 15px;
		}

		/* Filter */
		.filter-bar {
			background: #eef2ff;
			border-radius: .7rem;
			padding: 10px 15px;
			border: 1px solid #c7d2fe;
		}

		/* Summary Cards */
		.summary-box {
			background: white;
			border-radius: .7rem;
			padding: 12px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
			display: flex;
			align-items: center;
			transition: all .2s ease;
			min-height: 70px;
		}

		.summary-box i {
			font-size: 1.2rem;
			padding: 8px;
			border-radius: 50%;
			color: #fff;
		}

		.summary-box h6 {
			font-size: .75rem;
			font-weight: 600;
			color: #6b7280;
			margin-bottom: 2px;
		}

		.summary-box p {
			font-size: 1rem;
			font-weight: 700;
			margin: 0;
		}

		/* Badges */
		.badge-masuk {
			background: #22c55e;
			font-weight: 500;
			border-radius: 20px;
			padding: 3px 10px;
			font-size: .75rem;
		}

		.badge-keluar {
			background: #ef4444;
			font-weight: 500;
			border-radius: 20px;
			padding: 3px 10px;
			font-size: .75rem;
		}

		/* Table */
		.table thead th {
			background: #4f46e5;
			color: #fff;
			border: none;
			font-size: .85rem;
		}

		.table td,
		.table th {
			padding: 6px 10px;
			vertical-align: middle;
		}

		.table-hover tbody tr:hover {
			background: #f9fafb;
		}

		.footer-text {
			color: #6b7280;
			font-size: .75rem;
		}
	</style>
</head>

<body>

	<!-- Header -->
	<div class="header">
		<div class="container d-flex justify-content-between align-items-center">
			<div class="brand">
				<i class="fas fa-coins me-2"></i>Keuangan Modern
			</div>
			<div class="d-flex gap-2">
				<span class="btn btn-light btn-sm text-dark fw-semibold disabled">👋 Hai, <b>Admin</b></span>
				<a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">
					<i class="fas fa-right-from-bracket"></i> Logout
				</a>
			</div>
		</div>
		<div class="container mt-2">
			<h2 class="page-title"><i class="fas fa-file-invoice-dollar me-2"></i>Laporan Bulanan</h2>
		</div>
	</div>

	<!-- Content -->
	<div class="container py-3">
		<div class="card card-custom">

			<!-- Back -->
			<div class="mb-2">
				<a href="<?= site_url('dashboard'); ?>" class="btn btn-outline-secondary rounded-pill btn-sm">
					<i class="fas fa-arrow-left"></i> Kembali
				</a>
			</div>

			<!-- Filter -->
			<div class="filter-bar mb-3">
				<form method="get" class="row g-2 align-items-end">
					<div class="col-md-3">
						<label class="form-label fw-semibold">Tahun</label>
						<input type="number" name="year" class="form-control rounded-pill form-control-sm" value="<?= $year; ?>">
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Bulan</label>
						<input type="number" name="month" class="form-control rounded-pill form-control-sm" value="<?= $month; ?>" min="1" max="12">
					</div>
					<div class="col-md-6 text-end">
						<button class="btn btn-primary btn-sm rounded-pill">
							<i class="fas fa-eye"></i> Tampilkan
						</button>
						<a href="<?= site_url('laporan/export_pdf?year=' . $year . '&month=' . $month); ?>" class="btn btn-outline-danger btn-sm rounded-pill">
							<i class="fas fa-file-pdf"></i> PDF
						</a>
						<a href="<?= site_url('laporan/export_excel?year=' . $year . '&month=' . $month); ?>" class="btn btn-outline-success btn-sm rounded-pill">
							<i class="fa-solid fa-file-excel"></i> Excel
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
			<div class="row mb-2 g-2">
				<!-- Total Masuk -->
				<div class="col-md-4 col-12">
					<div class="summary-box">
						<i class="fas fa-circle-arrow-down bg-success"></i>
						<div class="ms-2">
							<h6>Total Masuk</h6>
							<p>Rp <?= number_format($total_masuk, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>

				<!-- Total Keluar -->
				<div class="col-md-4 col-12">
					<div class="summary-box">
						<i class="fas fa-circle-arrow-up bg-danger"></i>
						<div class="ms-2">
							<h6>Total Keluar</h6>
							<p>Rp <?= number_format($total_keluar, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>

				<!-- Saldo Akhir -->
				<div class="col-md-4 col-12">
					<div class="summary-box">
						<i class="fas fa-wallet bg-primary"></i>
						<div class="ms-2">
							<h6>Saldo Akhir</h6>
							<p>Rp <?= number_format($saldo, 0, ',', '.'); ?></p>
						</div>
					</div>
				</div>
			</div>
			<!-- End Ringkasan -->

			<!-- Tabel -->
			<div class="table-responsive">
				<table class="table table-hover align-middle shadow-sm">
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
		<p class="text-center footer-text mt-2">
			&copy; <?= date('Y'); ?> CI3 Keuangan — Laporan Bulanan
		</p>
	</div>
	<!-- End Content -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
 