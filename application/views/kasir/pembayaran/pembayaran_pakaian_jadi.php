<?php if($this->session->flashdata('success')): ?>
<div class="lavera-alert-modal" id="laveraAlertModal">
    <div class="success-box">
        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>
        <h3>Berhasil!</h3>
        <p><?= $this->session->flashdata('success'); ?></p>
    </div>
</div>
<?php endif; ?>

<div class="admin-page-header">
    <a href="#" class="btn-tambah-produk" id="openCashPaymentModal">
        <i class="fa-solid fa-plus"></i>
        Tambah Pembayaran Cash
    </a>
</div>

<div class="produk-card">

    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari pembayaran...">
        </div>

        <select class="filter-status">
            <option value="">Semua Status</option>
            <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
            <option value="berhasil">Berhasil</option>
            <option value="ditolak">Ditolak</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Bukti</th>
                    <th>Pembayaran</th>
                    <th>Customer</th>
                    <th>Produk</th>
                    <th>Metode</th>
                    <th>Jumlah Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($pembayaran as $p): ?>
                    <tr>
                        <td>
                            <?php if(!empty($p->bukti_pembayaran)): ?>
                                <a href="<?= base_url('assets/img/pembayaran/'.$p->bukti_pembayaran); ?>" target="_blank">
                                    <img src="<?= base_url('assets/img/pembayaran/' . $p->bukti_pembayaran); ?>" class="payment-proof-img">
                                </a>
                            <?php else: ?>
                                <div class="payment-proof-empty">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="produk-info">
                                <h4><?= $p->kode_pembayaran; ?></h4>
                                <span><?= $p->kode_pesanan; ?></span>
                                <small><?= date('d M Y H:i', strtotime($p->tanggal_pembayaran)); ?></small>
                            </div>
                        </td>

                        <td>
                            <div class="produk-info">
                                <h4><?= $p->nama_user; ?></h4>
                                <small><?= $p->no_telepon; ?></small>
                            </div>
                        </td>

                        <td>
                            <div class="produk-info">
                                <h4><?= $p->nama_pakaian; ?></h4>
                                <span>Ukuran: <?= $p->ukuran; ?></span>
                                <small>Jumlah: <?= $p->jumlah; ?> pcs</small>
                            </div>
                        </td>

                        <td><?= ucfirst($p->metode_pembayaran); ?></td>

                        <td>
                            Rp <?= number_format($p->jumlah_bayar,0,',','.'); ?>
                        </td>

                        <td>
                            <span class="payment-status <?= strtolower($p->status_pembayaran); ?>">
                                <?= ucwords(str_replace('_',' ', $p->status_pembayaran)); ?>
                            </span>
                        </td>

                        <td>
                            <div class="produk-action">

                                <a href="#"
                                   class="edit-btn open-payment-status-modal"
                                   data-id="<?= $p->id_pembayaran; ?>"
                                   data-kode="<?= $p->kode_pembayaran; ?>"
                                   data-status="<?= $p->status_pembayaran; ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <?php if($p->status_pembayaran == 'berhasil'): ?>
                                    <a href="<?= base_url('kasir/cetak-kwitansi/'.$p->id_pembayaran); ?>"
                                       class="print-btn">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div>

<!-- MODAL TAMBAH CASH -->
<div class="produk-modal" id="cashPaymentModal">
    <div class="produk-modal-box">

        <button class="close-produk-modal" id="closeCashPaymentModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Tambah Pembayaran Cash</h2>
            <p>Input pembayaran tunai pakaian jadi customer.</p>
        </div>

        <form action="<?= base_url('kasir/simpan-pembayaran-cash'); ?>" method="post">

            <div class="produk-modal-grid">

                <div class="produk-input-group produk-full">
                    <label>Pesanan Cash</label>
                    <select name="id_pesanan" required>
                        <option value="">Pilih Pesanan</option>
                        <?php foreach($pesanan_cash as $pc): ?>
                            <option value="<?= $pc->id_pesanan; ?>" data-total="<?= $pc->total_bayar; ?>">
                                <?= $pc->kode_pesanan; ?> - <?= $pc->nama_user; ?> - Rp <?= number_format($pc->total_bayar,0,',','.'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" required>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Pembayaran
            </button>

        </form>

    </div>
</div>

<!-- MODAL EDIT STATUS -->
<div class="produk-modal" id="paymentStatusModal">
    <div class="produk-modal-box">

        <button class="close-produk-modal" id="closePaymentStatusModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Edit Status Pembayaran</h2>
            <p>Verifikasi atau tolak pembayaran customer.</p>
        </div>

        <form action="<?= base_url('kasir/update-status-pembayaran'); ?>" method="post">

            <input type="hidden" name="id_pembayaran" id="edit_id_pembayaran">

            <div class="produk-modal-grid">

                <div class="produk-input-group produk-full">
                    <label>Kode Pembayaran</label>
                    <input type="text" id="edit_kode_pembayaran" readonly>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" id="edit_status_pembayaran" required>
                        <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                        <option value="berhasil">Berhasil</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Update Status
            </button>

        </form>

    </div>
</div>