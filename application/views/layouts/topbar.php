<?php $this->load->view('layouts/header'); ?>
<nav class="navbar-topbar">
        <ul class="nav-menu" id="navMenu">
            <li><a href="<?= base_url('home'); ?>">Home</a></li>
            <li><a href="<?= base_url('collection'); ?>">Collection</a></li>
            <li><a href="<?= base_url('about'); ?>">About</a></li>
            <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
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

            <div class="user-box">
                <i class="fa-regular fa-user"></i>
                <div class="user-dropdown">
                    <a href="<?= base_url('login'); ?>">Log In</a>
                    <a href="<?= base_url('register'); ?>">Sign Up</a>
                </div>
            </div>

            <div class="cart-box">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">0</span>
             <!--    <span class="cart-count"><?= $jumlah_cart; ?></span> -->
            </div>
        </div>
    </nav>