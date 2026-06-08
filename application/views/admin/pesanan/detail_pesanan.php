<div class="admin-detail-wrapper">

    <div class="detail-order-header">
        <div>
            <p>Detail Pesanan</p>
            <h1><?= $pesanan->kode_pesanan; ?></h1>
            <span><?= date('d F Y', strtotime($pesanan->tanggal_pesanan)); ?></span>
        </div>

        <div class="detail-status-group">
            <span class="payment-status <?= strtolower($pesanan->status_pembayaran ?? 'belum_bayar'); ?>">
                <?= ucwords(str_replace('_',' ', $pesanan->status_pembayaran ?? 'Belum Bayar')); ?>
            </span>

            <span class="order-status <?= strtolower($pesanan->status_pesanan); ?>">
                <?= ucwords(str_replace('_',' ', $pesanan->status_pesanan)); ?>
            </span>
        </div>
    </div>

    <div class="detail-order-grid">

        <div class="detail-main-card">
            <h3>Produk Dipesan</h3>

            <div class="detail-product-box">
                <img src="<?= base_url('assets/img/produk/' . $pesanan->foto_1); ?>">

                <div>
                    <h2><?= $pesanan->nama_pakaian; ?></h2>
                    <p>Ukuran: <?= $pesanan->ukuran; ?></p>
                    <p>Jumlah: <?= $pesanan->jumlah; ?> pcs</p>
                    <p>Harga: Rp <?= number_format($pesanan->harga,0,',','.'); ?></p>
                    <p>Subtotal: Rp <?= number_format($pesanan->subtotal,0,',','.'); ?></p>
                </div>
            </div>
        </div>

        <div class="detail-side-card">
            <h3>Ringkasan Pembayaran</h3>

            <div class="summary-row">
                <span>Total Bayar</span>
                <b>Rp <?= number_format($pesanan->total_bayar,0,',','.'); ?></b>
            </div>

            <div class="summary-row">
                <span>Metode</span>
                <b><?= ucfirst($pesanan->metode_pembayaran ?? '-'); ?></b>
            </div>

            <div class="summary-row">
                <span>Status</span>
                <b><?= ucwords(str_replace('_',' ', $pesanan->status_pembayaran ?? 'Belum Bayar')); ?></b>
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
                <span>Alamat Pengiriman</span>
                <b><?= $pesanan->alamat_pengiriman; ?></b>
            </div>
        </div>

        <div class="detail-info-card">
            <h3>Informasi Pengiriman</h3>

            <div class="info-row">
                <span>Metode Pengambilan</span>
                <b><?= ucfirst($pesanan->metode_pengambilan); ?></b>
            </div>

            <div class="info-row">
                <span>Ekspedisi</span>
                <b><?= $pesanan->ekspedisi ?? '-'; ?></b>
            </div>
        </div>

        <div class="detail-info-card">
            <h3>Informasi Pembayaran</h3>

            <div class="info-row">
                <span>Kode Pembayaran</span>
                <b><?= $pesanan->kode_pembayaran ?? '-'; ?></b>
            </div>

            <div class="info-row">
                <span>Jenis Pembayaran</span>
                <b><?= ucwords(str_replace('_',' ', $pesanan->jenis_pembayaran ?? '-')); ?></b>
            </div>

            <div class="info-row">
                <span>Jumlah Bayar</span>
                <b>
                    <?= !empty($pesanan->jumlah_bayar)
                        ? 'Rp ' . number_format($pesanan->jumlah_bayar,0,',','.')
                        : '-'; ?>
                </b>
            </div>

            <div class="info-row">
                <span>Tanggal Pembayaran</span>
                <b>
                    <?= !empty($pesanan->tanggal_pembayaran)
                        ? date('d F Y H:i', strtotime($pesanan->tanggal_pembayaran))
                        : '-'; ?>
                </b>
            </div>

            <?php if(!empty($pesanan->bukti_pembayaran)): ?>
                <div class="detail-payment-proof">
                    <h4>Bukti Pembayaran</h4>
                    <a href="<?= base_url('assets/img/pembayaran/' . $pesanan->bukti_pembayaran); ?>" target="_blank">
                        <img src="<?= base_url('assets/img/pembayaran/' . $pesanan->bukti_pembayaran); ?>">
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <div class="detail-action-bottom">
        <a href="<?= base_url('admin/pesanan-pakaian-jadi'); ?>" class="back-detail-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        <a href="<?= base_url('pesanan/nota-pakaian-jadi/'.$pesanan->id_pesanan); ?>"
            target="_blank"
            class="print-detail-btn">
                <i class="fa-solid fa-print"></i>
                Cetak Nota
        </a>
    </div>

</div>