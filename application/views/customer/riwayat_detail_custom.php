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
                $status_dp = strtolower(trim($pesanan->status_dp ?? 'belum_bayar'));
                $status_pelunasan = strtolower(trim($pesanan->status_pelunasan ?? ''));

                $sisa_pelunasan = $pesanan->estimasi_harga - $pesanan->uang_muka;
                ?>

                <?php if($status_dp == 'belum_bayar' || $status_dp == 'ditolak'): ?>

                    <a href="#" class="receipt-confirm-btn" id="openDpModal">
                        <i class="fa-solid fa-wallet"></i>
                        <?= $status_dp == 'ditolak' ? 'Upload Ulang DP' : 'Bayar Uang Muka'; ?>
                    </a>

                <?php elseif($status_dp == 'menunggu_verifikasi' || $status_dp == 'menunggu_pembayaran_cash'): ?>

                    <button type="button" class="receipt-wait-btn" disabled>
                        <i class="fa-solid fa-clock"></i>
                        Uang Muka Menunggu Verifikasi
                    </button>

                <?php elseif($status_dp == 'berhasil' && ($status_pelunasan == 'belum_bayar' || $status_pelunasan == 'ditolak')): ?>

                    <a href="#" class="receipt-confirm-btn" id="openPelunasanModal">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <?= $status_pelunasan == 'ditolak' ? 'Upload Ulang Pelunasan' : 'Bayar Pelunasan'; ?>
                    </a>

                <?php elseif($status_pelunasan == 'menunggu_verifikasi' || $status_pelunasan == 'menunggu_pembayaran_cash'): ?>

                    <button type="button" class="receipt-wait-btn" disabled>
                        <i class="fa-solid fa-clock"></i>
                        Pelunasan Menunggu Verifikasi
                    </button>

                <?php elseif($status_dp == 'berhasil' && $status_pelunasan == 'berhasil'): ?>
                    <a href="<?= base_url('pesanan/download_invoice/'.$pesanan->id_pesanan); ?>"
                    class="receipt-download-btn">
                        <i class="fa-solid fa-download"></i>
                        Download Kwitansi
                    </a>

            <?php endif; ?>
        </div>

    </div>
</section>

<div class="payment-confirm-modal" id="dpPaymentModal">
    <div class="payment-confirm-box">

        <button type="button" class="payment-confirm-close" id="closeDpModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="payment-confirm-header">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>" alt="Lavera">
            <h2>Pembayaran Uang Muka</h2>
            <p>Pilih metode pembayaran DP untuk melanjutkan proses custom.</p>
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
                <span>Kategori Custom</span>
                <b><?= $pesanan->kategori_custom; ?></b>
            </div>

            <div>
                <span>Nominal Uang Muka</span>
                <b>Rp <?= number_format($pesanan->uang_muka,0,',','.'); ?></b>
            </div>
        </div>

        <form action="<?= base_url('pesanan/simpan-pembayaran-custom'); ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_pesanan" value="<?= $pesanan->id_pesanan; ?>">
            <input type="hidden" name="id_request" value="<?= $pesanan->id_request; ?>">
            <input type="hidden" name="id_pembayaran" value="<?= $pesanan->id_pembayaran_dp; ?>">
            <input type="hidden" name="jenis_pembayaran" value="uang_muka_custom">

            <div class="order-input-group">
                <label>Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metodePembayaran" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer">Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
            </div>

            <div class="payment-info" id="dpTransferInfo">
                <h4><i class="fa-solid fa-building-columns"></i> Rekening Lavéra</h4>
                <p>BCA: <b>7435667040</b></p>
                <p>Atas Nama: <b>LAVERA FASHION</b></p>
            </div>

            <div class="payment-info" id="dpCashInfo">
                <h4><i class="fa-solid fa-store"></i> Pembayaran Cash</h4>
                <p>Silakan lakukan pembayaran uang muka langsung ke kasir Lavéra.</p>
            </div>

            <div class="payment-upload-group" id="dpUploadGroup">
                <label>Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept="image/*">
                <small>Format: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
            </div>

            <button type="submit" class="payment-confirm-submit">
                <i class="fa-solid fa-paper-plane"></i>
                Kirim Pembayaran Uang Muka
            </button>

        </form>
    </div>
</div>

<div class="payment-confirm-modal" id="pelunasanPaymentModal">
    <div class="payment-confirm-box">

        <button type="button" class="payment-confirm-close" id="closePelunasanModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="payment-confirm-header">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>" alt="Lavera">
            <h2>Pembayaran Pelunasan</h2>
            <p>Pilih metode pembayaran pelunasan untuk menyelesaikan pesanan custom.</p>
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
                <span>Total Custom</span>
                <b>Rp <?= number_format($pesanan->estimasi_harga,0,',','.'); ?></b>
            </div>

            <div>
                <span>Uang Muka</span>
                <b>Rp <?= number_format($pesanan->uang_muka,0,',','.'); ?></b>
            </div>

            <div>
                <span>Sisa Pelunasan</span>
                <b>Rp <?= number_format($sisa_pelunasan,0,',','.'); ?></b>
            </div>
        </div>

        <form action="<?= base_url('pesanan/simpan-pembayaran-custom'); ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_pesanan" value="<?= $pesanan->id_pesanan; ?>">
            <input type="hidden" name="id_request" value="<?= $pesanan->id_request; ?>">
            <input type="hidden" name="id_pembayaran" value="<?= $pesanan->id_pembayaran_pelunasan; ?>">
            <input type="hidden" name="jenis_pembayaran" value="pelunasan_custom">

            <div class="order-input-group">
                <label>Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metodePembayaran" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer">Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
            </div>

            <div class="payment-info" id="pelunasanTransferInfo">
                <h4><i class="fa-solid fa-building-columns"></i> Rekening Lavéra</h4>
                <p>BCA: <b>7435667040</b></p>
                <p>Atas Nama: <b>LAVERA FASHION</b></p>
            </div>

            <div class="payment-info" id="pelunasanCashInfo">
                <h4><i class="fa-solid fa-store"></i> Pembayaran Cash</h4>
                <p>Silakan lakukan pembayaran pelunasan langsung ke kasir Lavéra.</p>
            </div>

            <div class="payment-upload-group" id="pelunasanUploadGroup">
                <label>Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept="image/*">
                <small>Format: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
            </div>

            <button type="submit" class="payment-confirm-submit">
                <i class="fa-solid fa-paper-plane"></i>
                Kirim Pembayaran Pelunasan
            </button>

        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        function setupModal(openId, closeId, modalId){
            const openBtn = document.getElementById(openId);
            const closeBtn = document.getElementById(closeId);
            const modal = document.getElementById(modalId);

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

            if(modal){
                modal.addEventListener("click", function(e){
                    if(e.target === modal){
                        modal.classList.remove("active");
                    }
                });
            }
        }

        function setupPaymentMethod(selectId, transferId, cashId, uploadId){
            const select = document.getElementById(selectId);
            const transfer = document.getElementById(transferId);
            const cash = document.getElementById(cashId);
            const upload = document.getElementById(uploadId);
            const uploadInput = upload ? upload.querySelector("input[type='file']") : null;

            if(transfer) transfer.style.display = "none";
            if(cash) cash.style.display = "none";
            if(upload) upload.style.display = "none";
            if(uploadInput) uploadInput.required = false;

            if(select){
                select.addEventListener("change", function(){
                    if(transfer) transfer.style.display = "none";
                    if(cash) cash.style.display = "none";
                    if(upload) upload.style.display = "none";
                    if(uploadInput) uploadInput.required = false;

                    if(this.value === "transfer"){
                        if(transfer) transfer.style.display = "block";
                        if(upload) upload.style.display = "block";
                        if(uploadInput) uploadInput.required = true;
                    }

                    if(this.value === "cash"){
                        if(cash) cash.style.display = "block";
                    }
                });
            }
        }

        setupModal("openDpModal", "closeDpModal", "dpPaymentModal");
        setupModal("openPelunasanModal", "closePelunasanModal", "pelunasanPaymentModal");

        setupPaymentMethod("metodeDpPayment", "dpTransferInfo", "dpCashInfo", "dpUploadGroup");
        setupPaymentMethod("metodePelunasanPayment", "pelunasanTransferInfo", "pelunasanCashInfo", "pelunasanUploadGroup");

    });
</script>
<?php $this->load->view('layouts/footer'); ?>