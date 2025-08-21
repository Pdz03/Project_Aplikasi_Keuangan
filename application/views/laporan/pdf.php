<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan <?= $month ?>/<?= $year ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 5px; }
        h4 { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #2c3e50; color: #fff; }
        tfoot td { font-weight: bold; background-color: #f8f8f8; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h2>Laporan Keuangan</h2>
    <h4>Bulan <?= $month ?> Tahun <?= $year ?></h4>

    <table>
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
            <?php 
                $total = 0;
                if(!empty($rekap)): 
                    foreach($rekap as $row): 
                        $total += $row->nominal;
            ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                    <td><?= ucfirst($row->jenis) ?></td>
                    <td>Rp <?= number_format($row->nominal, 0, ',', '.') ?></td>
                    <td><?= $row->keterangan ?></td>
                </tr>
            <?php 
                    endforeach; 
                else: 
            ?>
                <tr><td colspan="5">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">TOTAL</td>
                <td colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        &copy; <?= date('Y') ?> Sistem Keuangan Sekolah - All Rights Reserved
    </div>
</body>
</html>
