<?php $this->load->view('layouts/header'); ?>

<section class="notification-page">
    <div class="notification-page-container">

        <div class="notification-page-header">
            <div>
                <p>Lavéra Notification</p>
                <h1>Notifikasi Saya</h1>
                <span>Informasi terbaru terkait pesanan dan pembayaran kamu.</span>
            </div>

            <a href="<?= base_url(); ?>" class="notif-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="notification-full-list">

            <?php if(!empty($notifikasi)): ?>

                <?php foreach($notifikasi as $n): ?>
                    <?php

$link_notif = base_url('notifikasi/detail/'.$n->id_notifikasi);

if(
    $n->jenis_notifikasi == 'pembayaran_berhasil'
    &&
    !empty($n->id_pesanan)
){
    $link_notif = base_url('pesanan/download_invoice/'.$n->id_pesanan);
}

if(
    $n->jenis_notifikasi == 'pelunasan_berhasil'
    &&
    !empty($n->id_pesanan)
){
    $link_notif = base_url('pesanan/download_invoice_custom/'.$n->id_pesanan);
}

?>

                    <a href="<?= $link_notif; ?>"
                        class="notification-full-item <?= $n->status_baca == 'belum_dibaca' ? 'unread' : ''; ?>">
                        <div class="notification-full-icon">
                            <i class="fa-regular fa-bell"></i>
                        </div>

                        <div class="notification-full-content">
                            <h3><?= $n->judul_notifikasi; ?></h3>
                            <p><?= $n->pesan_notifikasi; ?></p>
                            <small>
                                <?= date('d M Y H:i', strtotime($n->created_at)); ?>
                            </small>

                            <a href="<?= base_url('pesanan/download_invoice/'.$n->id_pesanan); ?>"
                                class="notif-print-btn">
                                    <i class="fa-solid fa-print"></i>
                                    Cetak Kwitansi
                            </a>
                        </div>

                        <?php if($n->status_baca == 'belum_dibaca'): ?>
                            <span class="notif-new-badge">Baru</span>
                        <?php endif; ?>

                    </a>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="notification-empty-page">
                    <i class="fa-regular fa-bell-slash"></i>
                    <h3>Belum ada notifikasi</h3>
                    <p>Notifikasi pesanan dan pembayaran kamu akan muncul di sini.</p>
                </div>

            <?php endif; ?>

        </div>

    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>