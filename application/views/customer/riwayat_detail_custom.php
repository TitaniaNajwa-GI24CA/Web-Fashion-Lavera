<?php $this->load->view('layouts/header'); ?>

<section class="receipt-page">
    <div class="receipt-box">

        <div class="receipt-header">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>"
                 class="receipt-logo"
                 alt="Lavéra">

            <div class="receipt-header-content">
                <p>Lavéra Custom Receipt</p>
                <h1>Detail Pesanan Custom</h1>
                <span><?= $pesanan->kode_pesanan; ?></span>
            </div>
        </div>

        <div class="receipt-products">
            <h3>Desain Custom</h3>

            <div class="receipt-product-item">
                <?php if(!empty($pesanan->gambar_desain)): ?>
                    <img src="<?= base_url('assets/img/request_custom/'.$pesanan->gambar_desain); ?>">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-product.png'); ?>">
                <?php endif; ?>

                <div>
                    <h4><?= $pesanan->kategori_custom; ?></h4>
                    <p>Status Request: <?= $pesanan->status_request; ?></p>
                    <p>Detail: <?= $pesanan->detail_custom; ?></p>
                </div>
            </div>
        </div>

        <div class="receipt-info-grid">

            <div>
                <small>Nama Customer</small>
                <h4><?= $pesanan->nama_user; ?></h4>
            </div>

            <div>
                <small>No. Telepon</small>
                <h4><?= $pesanan->no_telepon; ?></h4>
            </div>

            <div>
                <small>Tanggal Pesanan</small>
                <h4><?= date('d M Y', strtotime($pesanan->tanggal_pesanan)); ?></h4>
            </div>

            <div>
                <small>Status Pesanan</small>
                <h4><?= ucwords(str_replace('_',' ', $pesanan->status_pesanan)); ?></h4>
            </div>

            <div>
                <small>Estimasi Harga</small>
                <h4>Rp <?= number_format($pesanan->estimasi_harga,0,',','.'); ?></h4>
            </div>

            <div>
                <small>Diskon Custom</small>
                <h4><?= $pesanan->diskon_custom; ?>%</h4>
            </div>

            <div>
                <small>Uang Muka</small>
                <h4>Rp <?= number_format($pesanan->uang_muka,0,',','.'); ?></h4>
            </div>

            <div>
                <small>Sisa Pelunasan</small>
                <h4>
                    Rp <?= number_format(($pesanan->estimasi_harga - $pesanan->uang_muka),0,',','.'); ?>
                </h4>
            </div>

            <div>
                <small>Status Pembayaran</small>
                <h4><?= ucwords(str_replace('_',' ', $pesanan->status_pembayaran ?? 'belum_bayar')); ?></h4>
            </div>

            <div>
                <small>Metode Pembayaran</small>
                <h4><?= ucfirst($pesanan->metode_pembayaran ?? '-'); ?></h4>
            </div>

            <div class="receipt-full">
                <small>Alamat</small>
                <h4><?= $pesanan->alamat ?? '-'; ?></h4>
            </div>
        </div>

        <div class="receipt-total">
            <span>Total Estimasi</span>
            <h2>Rp <?= number_format($pesanan->estimasi_harga,0,',','.'); ?></h2>
        </div>

        <div class="receipt-actions">
            <a href="<?= base_url('riwayat-pesanan'); ?>" class="receipt-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <?php
            $status_bayar = strtolower(trim($pesanan->status_pembayaran ?? 'belum_bayar'));
            ?>

            <?php if($status_bayar == 'belum_bayar'): ?>
                <a href="#" class="receipt-confirm-btn" id="openPaymentModal">
                    <i class="fa-solid fa-upload"></i>
                    Bayar Uang Muka
                </a>
            <?php elseif($status_bayar == 'menunggu_verifikasi'): ?>
                <button type="button" class="receipt-wait-btn" disabled>
                    <i class="fa-solid fa-clock"></i>
                    Menunggu Verifikasi
                </button>
            <?php elseif($status_bayar == 'berhasil'): ?>
                <a href="<?= base_url('pesanan/download_invoice/'.$pesanan->id_pesanan); ?>"
                   class="receipt-download-btn">
                    <i class="fa-solid fa-download"></i>
                    Download Kwitansi
                </a>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>