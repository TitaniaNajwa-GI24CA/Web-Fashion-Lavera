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
                    <img src="<?= base_url('assets/img/produk/' . $d->foto_4); ?>">

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

            <?php
                $status_pembayaran = !empty($pesanan->status_pembayaran)
                    ? strtolower(trim($pesanan->status_pembayaran))
                    : 'belum_bayar';

                $metode_pembayaran = !empty($pesanan->metode_pembayaran)
                    ? strtolower(trim($pesanan->metode_pembayaran))
                    : '';
            ?>

            <?php if($metode_pembayaran == 'transfer' && $status_pembayaran == 'belum_bayar'): ?>
                <a href="#" class="receipt-confirm-btn" id="openPaymentModal">
                    <i class="fa-solid fa-upload"></i>
                    Konfirmasi Pembayaran
                </a>

            <?php elseif($metode_pembayaran == 'transfer' && $status_pembayaran == 'menunggu_verifikasi'): ?>
                <button type="button" class="receipt-wait-btn" disabled>
                    <i class="fa-solid fa-clock"></i>
                    Menunggu Verifikasi
                </button>

            <?php elseif($status_pembayaran == 'berhasil' || $status_pembayaran == 'lunas'): ?>
                <a href="<?= base_url('pesanan/download_invoice/'.$pesanan->id_pesanan); ?>"
                class="receipt-download-btn">
                    <i class="fa-solid fa-download"></i>
                    Download Invoice
                </a>

            <?php elseif($metode_pembayaran == 'cash'): ?>
                <button type="button" class="receipt-wait-btn" disabled>
                    <i class="fa-solid fa-store"></i>
                    Pembayaran Cash di Store
                </button>

            <?php endif; ?>
        </div>

    </div>

</section>

<div class="payment-confirm-modal" id="paymentConfirmModal">
    <div class="payment-confirm-box">

        <button type="button" class="payment-confirm-close" id="closePaymentModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="payment-confirm-header">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>" alt="Lavera">
            <h2>Konfirmasi Pembayaran</h2>
            <p>Upload bukti pembayaran untuk diverifikasi kasir Lavéra.</p>
        </div>

        <div class="payment-confirm-info">
            <div>
                <span>Nama Pemesan</span>
                <b><?= $pesanan->nama_user; ?></b>
            </div>

            <div>
                <span>Kode Pesanan</span>
                <b><?= $pesanan->kode_pesanan; ?></b>
            </div>

            <div>
                <span>Total Bayar</span>
                <b>Rp <?= number_format($pesanan->total_bayar,0,',','.'); ?></b>
            </div>

            <div>
                <span>Rekening Lavéra</span>
                <b>BCA 7435667040 a.n LAVERA FASHION</b>
            </div>
        </div>

        <form action="<?= base_url('pesanan/konfirmasi-pembayaran'); ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_pesanan" value="<?= $pesanan->id_pesanan; ?>">

            <div class="payment-upload-group">
                <label>Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept="image/*" required>
                <small>Format: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
            </div>

            <button type="submit" class="payment-confirm-submit">
                <i class="fa-solid fa-paper-plane"></i>
                Kirim Bukti Pembayaran
            </button>

        </form>
    </div>
</div>

<?php if($this->session->flashdata('payment_success')): ?>
<div class="payment-success-modal active" id="paymentSuccessModal">
    <div class="payment-success-box">
        <div class="payment-success-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <h3>Berhasil!</h3>
        <p><?= $this->session->flashdata('payment_success'); ?></p>
    </div>
</div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        const openBtn = document.getElementById("openPaymentModal");
        const closeBtn = document.getElementById("closePaymentModal");
        const modal = document.getElementById("paymentConfirmModal");

        if(openBtn && modal){
            openBtn.addEventListener("click", function(e){
                e.preventDefault();
                modal.classList.add("active");
            });
        }

        if(closeBtn && modal){
            closeBtn.addEventListener("click", function(){
                modal.classList.remove("active");
            });
        }
    });

    const successModal =
    document.getElementById("paymentSuccessModal");

    if(successModal){

        setTimeout(function(){

            successModal.style.opacity = "0";

            setTimeout(function(){
                successModal.remove();
            }, 300);

        }, 2200);

    }
</script>

<?php $this->load->view('layouts/footer'); ?>