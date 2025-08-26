<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi - CI Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f0f4ff, #e6f7ff);
    }

    .glass-card {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.85);
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
      border-radius: .75rem;
    }

    .btn-primary {
      background: linear-gradient(45deg, #0d6efd, #00c6ff);
      border: none;
    }

    .btn-primary:hover {
      background: linear-gradient(45deg, #0b5ed7, #0099cc);
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
    <div class="mx-auto" style="max-width:620px;">
      <div class="glass-card p-4">
        <h3 class="fw-semibold mb-4">
          <i class="bi bi-wallet2 me-2"></i>
          <?= isset($transaksi) ? 'Edit' : 'Tambah'; ?> Transaksi
        </h3>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="post" action="">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash(); ?>" />

          <div class="form-floating mb-3">
            <input type="date" name="tanggal" class="form-control" id="tanggalInput"
              value="<?= isset($transaksi) ? $transaksi->tanggal : date('Y-m-d'); ?>" required>
            <label for="tanggalInput"><i class="bi bi-calendar-event me-1"></i> Tanggal</label>
          </div>

          <div class="form-floating mb-3">
            <select name="jenis" class="form-select" id="jenisSelect" required>
              <option value="masuk" <?= (isset($transaksi) && $transaksi->jenis == 'masuk') ? 'selected' : ''; ?>>Pemasukan</option>
              <option value="keluar" <?= (isset($transaksi) && $transaksi->jenis == 'keluar') ? 'selected' : ''; ?>>Pengeluaran</option>
            </select>
            <label for="jenisSelect"><i class="bi bi-shuffle me-1"></i> Jenis Transaksi</label>
          </div>

          <div class="form-floating mb-3">
            <input type="number" name="nominal" class="form-control" id="nominalInput"
              value="<?= isset($transaksi) ? $transaksi->nominal : ''; ?>" required>
            <label for="nominalInput"><i class="bi bi-cash-coin me-1"></i> Nominal</label>
          </div>

          <div class="form-floating mb-3">
            <textarea name="keterangan" class="form-control" id="ketInput" style="height:100px"><?= isset($transaksi) ? $transaksi->keterangan : ''; ?></textarea>
            <label for="ketInput"><i class="bi bi-pencil-square me-1"></i> Keterangan</label>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="<?= site_url('transaksi'); ?>" class="btn btn-secondary">
              <i class="bi bi-arrow-left-circle me-1"></i> Batal
            </a>
            <button class="btn btn-primary">
              <i class="bi bi-save2 me-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>