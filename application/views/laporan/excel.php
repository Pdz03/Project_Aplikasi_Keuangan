<h3 style="text-align:center;">Laporan Transaksi</h3>
<p style="text-align:right;">Tanggal Export: <?= date('d-m-Y H:i'); ?></p>

<table border="1" width="100%">
    <thead>
        <tr style="background-color: #2c3e50; color: #ffffff; text-align: center; font-weight:bold;">
            <th>ID</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0; // inisialisasi
        foreach($laporan as $row): 
            $total += $row->nominal; // hitung total
        ?>
        <tr style="text-align: center;">
            <td><?= $row->id; ?></td>
            <td><?= $row->tanggal; ?></td>
            <td><?= $row->jenis; ?></td>
            <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
            <td><?= $row->keterangan; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr style="font-weight:bold; background:#ecf0f1;">
            <td colspan="3" style="text-align:ce;">TOTAL</td>
            <td style="text-align:center;">Rp <?= number_format($total, 0, ',', '.'); ?></td>
            <td></td>
        </tr>
    </tbody>
</table>
