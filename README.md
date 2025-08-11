# CI3 Starter Project - Pencatatan Keuangan (For PKL)

Instruksi singkat:
1. Copy folder `application/` ke dalam instalasi CodeIgniter 3 yang sudah kamu download.
2. Edit `application/config/database.php` untuk koneksi database kamu.
3. Import `database.sql` ke MySQL (untuk password default admin lihat catatan di bawah).
4. Aplikasi sederhana ini dibuat sengaja **tidak lengkap**. Di banyak tempat ada komentar `TODO:` yang harus diselesaikan oleh tim PKL.

Catatan tentang password admin:
- Pada `database.sql` kolom password diisi `<PWD_HASH_PLACEHOLDER>`. Silakan jalankan query ini untuk membuat password hash (menggunakan PHP):
```php
<?php
echo password_hash('password', PASSWORD_DEFAULT);
```
Lalu replace placeholder dengan hasil hash tersebut.

Daftar TODO utama untuk siswa:
- Implement export PDF (laporan) — gunakan Dompdf atau mPDF.
- Implement export Excel — gunakan PhpSpreadsheet.
- Tambah validasi form & csrf.
- Tambah pagination & filter range tanggal.
- Tambah user management (create user, roles).
- Buat unit tests sederhana untuk model.

Struktur utama:
- controllers/: Auth, Dashboard, Transaksi, Laporan
- models/: User_model, Transaksi_model
- views/: simple views (plain HTML)

License: MIT
