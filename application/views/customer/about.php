<?php $this->load->view('layouts/header'); ?>
<section class="about-page" id="about" data-aos="fade-up">
    <div class="about-hero">
        <div class="about-hero-content">
            <p>About Lavéra</p>
            <h1>Crafted for Your Style</h1>

            <span>
                Lavéra adalah brand fashion yang menghadirkan koleksi ready to wear dan custom outfit
                dengan desain elegan, nyaman, dan dibuat untuk menyesuaikan gaya personal setiap pelanggan.
            </span>
        </div>
    </div>
    <div class="owner-section">
        <div class="section-title">
            <p>Meet The Founders</p>
        </div>
        <div class="owner-grid">

            <div class="owner-card">
                <img src="<?= base_url('assets/img/owner-riska.png'); ?>" alt="Riska Yulia Rahma">
                <h3>Riska Yulia Rahma</h3>
                <ul>
                    <li>Founder Lavéra</li>
                    <li>Product & Fashion Concept</li>
                    <li>Customer Styling Support</li>
                </ul>
            </div>

            <div class="owner-card">
                <img src="<?= base_url('assets/img/owner-titania.jpg'); ?>" alt="Titania Najwa">
                <h3>Titania Najwa</h3>
                <ul>
                    <li>Founder Lavéra</li>
                    <li>Website & Brand Development</li>
                    <li>Custom Order Management</li>
                </ul>
            </div>

            <div class="owner-card">
                <img src="<?= base_url('assets/img/owner-fitriana.png'); ?>" alt="Fitriana Hendayati">
                <h3>Fitriana Hendayati</h3>
                <ul>
                    <li>Founder Lavéra</li>
                    <li>Marketing & Customer Relation</li>
                    <li>Transaction Support</li>
                </ul>
            </div>

        </div>
    </div>

    <section class="transaction-guide" id="transaction-guide">

        <div class="section-title">
            <p>How To Order</p>
            <h2>Panduan Transaksi</h2>
        </div>

        <h3 class="guide-subtitle">Ready To Wear</h3>

        <div class="guide-grid">

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-ready-1.png'); ?>" alt="">
                </div>
            </div>

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-ready-2.png'); ?>" alt="">
                </div>
            </div>

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-ready-3.png'); ?>" alt="">
                </div>
            </div>

        </div>

        <h3 class="guide-subtitle">Custom Outfit</h3>

        <div class="guide-grid">

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-custom-1.png'); ?>" alt="">
                </div>
            </div>

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-custom-2.png'); ?>" alt="">
                </div>
            </div>

            <div class="guide-card">
                <div class="guide-image">
                    <img src="<?= base_url('assets/img/guide-custom-3.png'); ?>" alt="">
                </div>
            </div>

        </div>
    </section>


   <div class="about-cta">
        <div class="cta-overlay"></div>
        <div class="about-cta-content">
            <h2>
                Ready To Create Your Style?
            </h2>
            <span>
                Temukan koleksi terbaik dan wujudkan outfit impianmu bersama Lavéra.
            </span>
            <div class="about-cta-btn">
                <a href="<?= base_url('collection'); ?>">
                    Shop Collection
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?= base_url('custom-outfit'); ?>">
                    Custom Outfit
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

</section>

<?php $this->load->view('layouts/footer'); ?>