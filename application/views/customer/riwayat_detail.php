<?php $this->load->view('layouts/header'); ?>

<section class="receipt-page">

    <div class="receipt-box">

        <div class="receipt-header">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>"
                class="receipt-logo"
                alt="Lavéra">

            <div class="receipt-header-content">
                <p>Lavéra Receipt</p>
                <h1>Detail Pesanan</h1>
                <span><?= $pesanan->kode_pesanan; ?></span>
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
                <h4><?= $pesanan->status_pesanan; ?></h4>
            </div>

            <div class="receipt-full">
                <small>Alamat Pengiriman</small>
                <h4><?= $pesanan->alamat_pengiriman; ?></h4>
            </div>

            <div>
                <small>Ekspedisi</small>
                <h4><?= $pesanan->ekspedisi ?? '-'; ?></h4>
            </div>

            <div>
                <small>Metode Pembayaran</small>
                <h4><?= $pesanan->metode_pembayaran ?? '-'; ?></h4>
            </div>
        </div>

        <div class="receipt-products">
            <h3>Rincian Produk</h3>

            <?php foreach($detail_produk as $d): ?>
                <div class="receipt-product-item">
                    <img src="<?= base_url('assets/img/produk/' . $d->foto_1); ?>">

                    <div>
                        <h4><?= $d->nama_pakaian; ?></h4>
                        <p>Ukuran: <?= $d->ukuran; ?></p>
                        <p>Jumlah: <?= $d->jumlah; ?></p>
                    </div>

                    <strong>
                        Rp <?= number_format($d->subtotal,0,',','.'); ?>
                    </strong>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="receipt-total">
            <span>Total Bayar</span>
            <h2>Rp <?= number_format($pesanan->total_bayar,0,',','.'); ?></h2>
        </div>

        <div class="receipt-actions">
            <a href="<?= base_url('riwayat-pesanan'); ?>" class="receipt-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <?php if(($pesanan->metode_pembayaran ?? '') == 'transfer'): ?>
                <a href="#" class="receipt-confirm-btn">
                    <i class="fa-solid fa-upload"></i>
                    Konfirmasi Pembayaran
                </a>
            <?php endif; ?>
        </div>

    </div>

</section>

<?php $this->load->view('layouts/footer'); ?>