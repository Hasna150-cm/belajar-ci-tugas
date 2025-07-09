<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php helper('number'); ?>
<h4>Laporan Pendapatan</h4>
<form method="get" class="row g-3 mb-3">
    <div class="col-auto">
        <input type="date" name="start" class="form-control" value="<?= esc($start) ?>" required>
    </div>
    <div class="col-auto">
        <input type="date" name="end" class="form-control" value="<?= esc($end) ?>" required>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </div>
    <div class="col-auto">
        <a href="<?= base_url('laporan/exportPDF?start=' . $start . '&end=' . $end) ?>" class="btn btn-danger">Cetak PDF</a>
        <a href="<?= base_url('laporan/exportExcel?start=' . $start . '&end=' . $end) ?>" class="btn btn-success">Export Excel</a>
    </div>
</form>
<table class="table table-bordered">
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
        <tr class="table-warning">
            <td colspan="4"><b>Total Pendapatan</b></td>
            <td colspan="2"><b><?= number_to_currency($total, 'IDR') ?></b></td>
        </tr>
    </tbody>
</table>
<?= $this->endSection() ?>
