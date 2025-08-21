<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Daftar Transaksi - CI Keuangan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
	<style>
		body {
			background: #f4f6f9;
		}

		.table-hover tbody tr:hover {
			background-color: #f1f8ff;
			transition: background 0.2s;
		}

		.badge-masuk {
			background-color: #198754;
			font-weight: 500;
		}

		.badge-keluar {
			background-color: #dc3545;
			font-weight: 500;
		}

		.action-btns .btn {
			border-radius: 50%;
			width: 32px;
			height: 32px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			padding: 0;
		}

		.summary-box {
			border-radius: 0.75rem;
			padding: 1rem;
			color: #fff;
		}

		.summary-masuk {
			background: #198754;
		}

		.summary-keluar {
			background: #dc3545;
		}

		.summary-saldo {
			background: #0d6efd;
		}

		.table thead tr th {
			background-color: #2c3e50;
			color: #fff;
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
					<thead>
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
						<?php if (!empty($transaksi)): ?>
							<?php foreach ($transaksi as $t): ?>
								<tr>
									<td><?= $t->id; ?></td>
									<td><?= date('d M Y', strtotime($t->tanggal)); ?></td>
									<td>
										<?php if ($t->jenis == 'masuk'): ?>
											<span class="badge badge-masuk">Masuk</span>
										<?php else: ?>
											<span class="badge badge-keluar">Keluar</span>
										<?php endif; ?>
									</td>
									<td class="<?= $t->jenis == 'masuk' ? 'text-success fw-semibold' : 'text-danger fw-semibold'; ?>">
										Rp <?= number_format($t->nominal, 0, ',', '.'); ?>
									</td>
									<td><?= $t->keterangan; ?></td>
									<td class="text-center action-btns">
										<a href="<?= site_url('transaksi/edit/' . $t->id); ?>" class="btn btn-sm btn-primary" title="Edit">
											<i class="bi bi-pencil"></i>
										</a>
										<a href="<?= site_url('transaksi/delete/' . $t->id); ?>" class="btn btn-sm btn-danger"
											onclick="return confirm('Hapus transaksi ini?')" title="Hapus">
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
