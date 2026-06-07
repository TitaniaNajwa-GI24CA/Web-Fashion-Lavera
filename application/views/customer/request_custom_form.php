<?php $this->load->view('layouts/header'); ?>

<section class="order-page">
    <div class="order-container">

        <div class="order-product-card">
            <img src="<?= base_url('assets/img/custom/' . $custom->gambar_referensi); ?>">

            <h2><?= $custom->kategori_custom; ?></h2>
            <p><?= $custom->deskripsi_referensi; ?></p>

            <div class="order-detail-list">
                <span>Kategori <b><?= $custom->kategori_custom; ?></b></span>
                <span>Status <b><?= $custom->status_custom; ?></b></span>
                <span>Estimasi <b>Menunggu Admin</b></span>
            </div>
        </div>

        <div class="order-form-card">
            <h1>Form Request Custom</h1>
            <p>Lengkapi detail outfit custom yang kamu inginkan.</p>

            <?php if($this->session->flashdata('error')): ?>
                <div class="request-alert-error">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('request-custom/simpan'); ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_customer" value="<?= $customer->id_customer; ?>">
                <input type="hidden" name="id_custom" value="<?= $custom->id_custom; ?>">

                <div class="order-form-grid">

                    <div class="order-input-group">
                        <label>Nama Lengkap</label>
                        <input type="text" value="<?= $customer->nama_user; ?>" readonly>
                    </div>

                    <div class="order-input-group">
                        <label>No. Telepon</label>
                        <input type="text" value="<?= $customer->no_telepon; ?>" readonly>
                    </div>

                    <div class="order-input-group order-full">
                        <label>Alamat</label>
                        <textarea readonly><?= $customer->alamat; ?></textarea>
                    </div>

                    <div class="order-input-group order-full">
                        <label>Detail Custom</label>
                        <textarea name="detail_custom" required placeholder="Contoh: Saya ingin dress warna sage green, model A-line, panjang midi, bahan flowy, detail pita di pinggang, ukuran M, untuk acara formal."></textarea>
                    </div>

                    <div class="order-input-group order-full">
                        <label>Upload Gambar Desain / Referensi</label>
                        <input type="file" name="gambar_desain" accept="image/*" required>
                        <small class="request-file-note">
                            Upload contoh desain, sketsa, atau referensi outfit. Format JPG, PNG, WEBP. Maksimal 2MB.
                        </small>
                    </div>

                </div>

                <div class="request-info-box">
                    <h4>
                        <i class="fa-solid fa-circle-info"></i>
                        Informasi Request
                    </h4>
                    <p>
                        Setelah request dikirim, admin akan mengecek detail custom, menentukan estimasi harga,
                        uang muka, dan memberikan konfirmasi apakah request diterima atau ditolak.
                    </p>
                </div>

                <div class="order-buttons">
                    <a href="<?= base_url('custom-outfit'); ?>" class="order-cancel-btn">
                        Batal
                    </a>

                    <button type="submit" class="order-submit-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        Kirim Request
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>