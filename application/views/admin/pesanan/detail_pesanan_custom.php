<div class="admin-detail-wrapper">

    <div class="detail-order-header">
        <div>
            <p>Detail Pesanan Custom</p>
            <h1><?= $pesanan->kode_pesanan; ?></h1>
            <span><?= date('d F Y H:i', strtotime($pesanan->tanggal_pesanan)); ?> WIB</span>
        </div>

        <div class="detail-status-group">
            <span class="payment-status <?= strtolower($pesanan->status_pembayaran ?? 'belum_bayar'); ?>">
                <?= ucwords(str_replace('_',' ', $pesanan->status_pembayaran ?? 'belum_bayar')); ?>
            </span>

            <span class="order-status <?= strtolower($pesanan->status_pesanan); ?>">
                <?= ucwords(str_replace('_',' ', $pesanan->status_pesanan)); ?>
            </span>
        </div>
    </div>

    <div class="detail-order-grid">

        <div class="detail-main-card">
            <h3>Desain Custom</h3>

            <div class="detail-product-box">
                <?php if(!empty($pesanan->gambar_desain)): ?>
                    <img src="<?= base_url('assets/img/request_custom/'.$pesanan->gambar_desain); ?>">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-product.png'); ?>">
                <?php endif; ?>

                <div>
                    <h2><?= $pesanan->kategori_custom; ?></h2>
                    <p>Status Request: <?= $pesanan->status_request; ?></p>
                    <p>Estimasi Harga: Rp <?= number_format($pesanan->estimasi_harga,0,',','.'); ?></p>
                    <p>Diskon Custom: <?= $pesanan->diskon_custom; ?>%</p>
                    <p>Uang Muka: Rp <?= number_format($pesanan->uang_muka,0,',','.'); ?></p>
                </div>
            </div>
        </div>

        <div class="detail-side-card">
            <h3>Ringkasan Custom</h3>

            <div class="summary-row">
                <span>Total Custom</span>
                <b>Rp <?= number_format($pesanan->total_bayar,0,',','.'); ?></b>
            </div>

            <div class="summary-row">
                <span>Uang Muka</span>
                <b>Rp <?= number_format($pesanan->uang_muka,0,',','.'); ?></b>
            </div>

            <div class="summary-row">
                <span>Sisa Pelunasan</span>
                <b>
                    Rp <?= number_format(($pesanan->total_bayar - $pesanan->uang_muka),0,',','.'); ?>
                </b>
            </div>

            <div class="summary-row">
                <span>Jenis Pembayaran</span>
                <b><?= ucwords(str_replace('_',' ', $pesanan->jenis_pembayaran ?? '-')); ?></b>
            </div>
        </div>

    </div>

    <div class="detail-info-grid">

        <div class="detail-info-card">
            <h3>Data Customer</h3>

            <div class="info-row">
                <span>Nama</span>
                <b><?= $pesanan->nama_user; ?></b>
            </div>

            <div class="info-row">
                <span>Email</span>
                <b><?= $pesanan->email; ?></b>
            </div>

            <div class="info-row">
                <span>No. Telepon</span>
                <b><?= $pesanan->no_telepon; ?></b>
            </div>

            <div class="info-row">
                <span>Alamat</span>
                <b><?= $pesanan->alamat; ?></b>
            </div>
        </div>

        <div class="detail-info-card">
            <h3>Detail Request</h3>

            <div class="info-row">
                <span>Kategori</span>
                <b><?= $pesanan->kategori_custom; ?></b>
            </div>

            <div class="info-row">
                <span>Tanggal Request</span>
                <b><?= date('d F Y H:i', strtotime($pesanan->tanggal_request)); ?></b>
            </div>

            <div class="info-row">
                <span>Detail Custom</span>
                <b><?= $pesanan->detail_custom; ?></b>
            </div>
        </div>

        <div class="detail-info-card">
            <h3>Informasi Pembayaran</h3>

            <div class="info-row">
                <span>Kode Pembayaran</span>
                <b><?= $pesanan->kode_pembayaran ?? '-'; ?></b>
            </div>

            <div class="info-row">
                <span>Metode</span>
                <b><?= ucfirst($pesanan->metode_pembayaran ?? '-'); ?></b>
            </div>

            <div class="info-row">
                <span>Jumlah Bayar</span>
                <b>
                    <?= !empty($pesanan->jumlah_bayar)
                        ? 'Rp '.number_format($pesanan->jumlah_bayar,0,',','.')
                        : '-'; ?>
                </b>
            </div>

            <div class="info-row">
                <span>Status Bayar</span>
                <b><?= ucwords(str_replace('_',' ', $pesanan->status_pembayaran ?? 'belum_bayar')); ?></b>
            </div>

            <?php if(!empty($pesanan->bukti_pembayaran)): ?>
                <div class="detail-payment-proof">
                    <h4>Bukti Pembayaran</h4>
                    <a href="<?= base_url('assets/img/pembayaran/'.$pesanan->bukti_pembayaran); ?>" target="_blank">
                        <img src="<?= base_url('assets/img/pembayaran/'.$pesanan->bukti_pembayaran); ?>">
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <div class="detail-action-bottom">
        <a href="<?= base_url('admin/pesanan-custom'); ?>" class="back-detail-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        <a href="<?= base_url('pesanan/nota-custom/'.$pesanan->id_pesanan); ?>"
            target="_blank"
            class="print-detail-btn">
                <i class="fa-solid fa-print"></i>
                Cetak Nota
        </a>
    </div>

</div>