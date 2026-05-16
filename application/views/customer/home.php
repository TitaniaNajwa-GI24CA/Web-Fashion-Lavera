<?php $this->load->view('layouts/header'); ?>
<section class="hero" id="home" data-aos="fade-up">
    <nav class="navbar">
        <ul class="nav-menu" id="navMenu">
            <li><a href="#home">Home</a></li>
            <li><a href="#collection">Collection</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        
        <div class="logo-text">LAVÉRA</div>
        <div class="menu-toggle" id="menuToggle">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="nav-icons">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <form class="search-form" action="<?= base_url('search'); ?>" method="get">
                    <input type="text" name="keyword" placeholder="Search product...">
                </form>
            </div>

            <div class="cart-box">
                <i class="fa-regular fa-heart"></i>
             <!--    <span class="cart-count"><?= $jumlah_cart; ?></span> -->
            </div>
            
            <div class="cart-box">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">0</span>
             <!--    <span class="cart-count"><?= $jumlah_cart; ?></span> -->
            </div>

            <div class="user-box">
                <i class="fa-regular fa-user"></i>
                <div class="user-dropdown">
                    <a href="<?= base_url('login'); ?>">Log In</a>
                    <a href="<?= base_url('register'); ?>">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero-overlay">
        <div class="hero-text">
            <p class="small-title">Welcome to</p>
            <h1>LAVÉRA</h1>
            <h2>Crafted for Your Style</h2>

            <p class="hero-desc">
                Discover elegant ready-to-wear collections and custom outfits
                designed to express your personal style.
            </p>

            <div class="hero-buttons">
                <a href="<?= base_url('collection'); ?>" class="btn btn-primary">Shop Collection</a>
                <a href="<?= base_url('custom-outfit'); ?>" class="btn btn-outline">Custom Outfit</a>
            </div>
        </div>
    </div>

</section>
<?php $this->load->view('customer/about'); ?>
<?php $this->load->view('customer/collection'); ?>
<?php $this->load->view('customer/custom'); ?>
<?php $this->load->view('customer/contact'); ?>

