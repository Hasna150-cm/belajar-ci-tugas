<?php
// v_laporan_pendapatan_pdf.php
helper('number');
?>
<h3 style="text-align:center">Laporan Pendapatan</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>User</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; foreach ($laporan as $i => $row): $total += $row['total_harga']; ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= number_to_currency($row['total_harga'], 'IDR') ?></td>
            <td><?= [1=>'Paid',2=>'Shipped',3=>'Completed',4=>'Cancelled'][$row['status']] ?? '-' ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="4"><b>Total Pendapatan</b></td>
            <td colspan="2"><b><?= number_to_currency($total, 'IDR') ?></b></td>
        </tr>
    </tbody>
</table>
