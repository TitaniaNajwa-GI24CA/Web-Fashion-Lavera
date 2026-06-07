<?php $this->load->view('layouts/header'); ?>

<section class="history-page">

    <div class="history-page-header">
        <p>Order History</p>
        <h1>Riwayat Pesanan</h1>
        <span>Pantau status pesanan pakaian jadi dan request custom kamu.</span>
    </div>

    <div class="history-filter">
        <button class="history-filter-btn active" data-filter="all">Semua</button>
        <button class="history-filter-btn" data-filter="pakaian_jadi">Pakaian Jadi</button>
        <button class="history-filter-btn" data-filter="custom">Request Custom</button>
    </div>

    <div class="history-list-wrapper">

        <?php if(!empty($riwayat)): ?>

            <?php foreach($riwayat as $r): ?>
               <a href="<?= base_url('pesanan/detail/' . $r->id_pesanan); ?>" class="history-order-card" data-type="<?= strtolower(trim($r->tipe_pesanan)); ?>">
                    <div class="history-order-left">
                        <div class="history-order-image">
                            <?php if($r->tipe_pesanan == 'pakaian_jadi'): ?>
                                <img src="<?= base_url('assets/img/produk/' . $r->foto_4); ?>">
                            <?php else: ?>
                            <?php if(!empty($r->gambar_desain)): ?>
                                <img src="<?= base_url('assets/img/request_custom/' . $r->gambar_desain); ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/default-product.png'); ?>">
                             <?php endif; ?>
                            <?php endif; ?>
                        </div>
                         <div class="history-order-info">
                            <h3>
                                <?= !empty($r->nama_pakaian) ? $r->nama_pakaian : 'Custom Outfit'; ?>
                            </h3>
                            <p><?= $r->kode_pesanan; ?></p>
                             <small>
                                <?= date('d M Y', strtotime($r->tanggal_pesanan)); ?>
                            </small>
                        </div>
                    </div>

                    <div class="history-order-right">
                        <h4>
                            Rp <?= number_format($r->total_bayar,0,',','.'); ?>
                        </h4>

                        <span class="history-status <?= strtolower($r->status_pesanan); ?>">
                            <?= ucfirst($r->status_pesanan); ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="history-empty-state" id="emptyAll">
                <i class="fa-solid fa-receipt"></i>
                <h3>Belum ada riwayat pesanan</h3>
                <p>Kamu belum memiliki pesanan pakaian jadi maupun request custom.</p>

                <div class="history-empty-actions">
                    <a href="<?= base_url('collection'); ?>">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Mulai Belanja Pakaian Jadi
                    </a>

                    <a href="<?= base_url('custom-outfit'); ?>">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        Request Custom
                    </a>
                </div>
            </div>

            <div class="history-empty-state" id="emptyReady">
                <i class="fa-solid fa-bag-shopping"></i>
                <h3>Belum ada pesanan pakaian jadi</h3>
                <p>Yuk pilih koleksi ready-to-wear Lavéra favoritmu.</p>

                <div class="history-empty-actions single">
                    <a href="<?= base_url('collection'); ?>">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Mulai Belanja
                    </a>
                </div>
            </div>

            <div class="history-empty-state" id="emptyCustom">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <h3>Belum ada request custom</h3>
                <p>Buat outfit impianmu dengan layanan custom Lavéra.</p>

                <div class="history-empty-actions single">
                    <a href="<?= base_url('custom-outfit'); ?>">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        Mulai Request Custom
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>

</section>

<?php $this->load->view('layouts/footer'); ?>