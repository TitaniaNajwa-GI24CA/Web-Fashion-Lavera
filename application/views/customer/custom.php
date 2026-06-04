<?php $this->load->view('layouts/header'); ?>
<section class="custom-main" id="custom" data-aos="fade-up">
    <div class="custom-main-header">
        <p>Custom Outfit</p>
        <h1>Design Your Dream Outfit</h1>
        <span>Pilih kategori untuk mulai membuat outfit impianmu</span>
    </div>

    <div class="custom-main-grid" data-aos="fade-up">

        <a href="<?= base_url('custom_family'); ?>" class="custom-main-card">
            <img src="<?= base_url('assets/img/custom-family.png'); ?>" alt="Custom Family">
            <div class="custom-main-overlay family">
                <h2>Custom<br>Family<br>Uniform</h2>
                <span>Custom This Style <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?= base_url('custom_formal'); ?>" class="custom-main-card">
            <img src="<?= base_url('assets/img/custom-office.png'); ?>" alt="Custom Formal">
            <div class="custom-main-overlay formal">
                <h2>Custom<br>Formal<br>Wear</h2>
                <span>Custom This Style <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?= base_url('custom_occasion'); ?>" class="custom-main-card">
            <img src="<?= base_url('assets/img/custom-occasion.png'); ?>" alt="Custom Occasion">
            <div class="custom-main-overlay occasion">
                <h2>Custom<br>Occasion<br>Wear</h2>
                <span>Custom This Style <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>

        <a href="<?= base_url('custom_casual'); ?>" class="custom-main-card">
            <img src="<?= base_url('assets/img/custom-casual.png'); ?>" alt="Custom Casual">
            <div class="custom-main-overlay casual">
                <h2>Custom<br>Casual<br>Wear</h2>
                <span>Custom This Style <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>

        <?php if(!empty($custom_db)): ?>
            <?php foreach($custom_db as $c): ?>
                <a href="<?= base_url('custom-detail-db/'.$c->id_custom); ?>"
                class="custom-main-card">
                    <img src="<?= base_url('assets/img/custom/'.$c->gambar_referensi); ?>"
                        alt="<?= $c->kategori_custom; ?>">
                    <div class="custom-main-overlay">
                        <h2>
                            <?= $c->kategori_custom; ?>
                        </h2>
                        <span>
                            Custom This Style
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>