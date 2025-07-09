<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
History Transaksi Pembelian <strong><?= $username ?></strong>
<hr>
<div class="table-responsive">
    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">Waktu Pembelian</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Alamat</th>
                <th scope="col">Status</th>
                <th scope="col">Bukti Bayar</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($buy)) :
                foreach ($buy as $index => $item) :
            ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 ?></th>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['created_at'] ?></td>
                        <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?php echo $item['alamat'] ?></td>
                        <td><?php echo [
                            0 => 'Menunggu Pembayaran', 
                            1 => 'Sudah Dibayar', 
                            2 => 'Sedang Dikirim', 
                            3 => 'Sudah Selesai', 
                            4 => 'Dibatalkan' 
                            ][$item['status']] ?? 'Status Tidak Diketahui' ?> 
                        </td>
                        <td>
                            <?php if (!empty($item['bukti_bayar'])): ?>
                                <img src="<?= base_url('writable/uploads/' . $item['bukti_bayar']) ?>" width="100px" alt="Bukti Bayar">
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                Detail
                            </button>
                            <?php if ($item['status'] == 0): ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#uploadModal-<?= $item['id'] ?>">
                                Upload Bukti
                            </button>
                            <?php endif; ?>
                        </td>
                    <!-- Upload Bukti Modal Begin -->
                    <div class="modal fade" id="uploadModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('transaksi/uploadBukti/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="bukti" class="form-label">Pilih File Bukti (gambar)</label>
                                            <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Bukti Modal End -->
                    </tr>
                    <!-- Detail Modal Begin -->
                    <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php 
                                    if(!empty($product)){
                                        foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                            <?php echo $index2 + 1 . ")" ?>
                                            <?php if ($item2['foto'] != '' and file_exists("img/" . $item2['foto'] . "")) : ?>
                                                <img src="<?php echo base_url() . "img/" . $item2['foto'] ?>" width="100px">
                                            <?php endif; ?>
                                            <strong><?= $item2['nama'] ?></strong>
                                            <?= number_to_currency($item2['harga'], 'IDR') ?>
                                            <br>
                                            <?= "(" . $item2['jumlah'] . " pcs)" ?><br>
                                            <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                            <hr>
                                        <?php 
                                        endforeach; 
                                    }
                                    ?>
                                    Ongkir <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Detail Modal End -->
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</div>
<?= $this->endSection() ?>