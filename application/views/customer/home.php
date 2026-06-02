<?php if($this->session->flashdata('success')): ?>
    <div class="lavera-alert-modal" id="laveraAlertModal">
        <div class="success-box">
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3>Berhasil!</h3>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
    </div>
<?php endif; ?>
<?php $this->load->view('layouts/header'); ?>

<section class="hero" id="home" data-aos="fade-up">
    <nav class="navbar">
        <ul class="nav-menu" id="navMenu">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#howtoorder">How To Order</a></li>
            <li><a href="#favorite">Favorite</a></li>
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
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">0</span>
             <!--    <span class="cart-count"><?= $jumlah_cart; ?></span> -->
            </div>

            <div class="cart-box">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span class="cart-count">0</span>
            </div>

            <div class="cart-box">
                <i class="fa-regular fa-bell"></i>
                <span class="cart-count">2</span>
            </div>

            <div class="user-box profile-box">
            <?php if($this->session->userdata('login') == TRUE && $this->session->userdata('role') == 'customer'): ?>
                <?php
                    $foto = !empty($customer->foto_profil)
                        ? 'assets/img/profile/' . $customer->foto_profil
                        : 'assets/img/profile-basic.jpg';
                ?>
                <img src="<?= base_url($foto); ?>" class="profile-avatar" alt="Profile">
                <div class="user-dropdown profile-dropdown">
                    <div class="profile-dropdown-header">
                        <img src="<?= base_url($foto); ?>" alt="Profile">
                        <div>
                            <h4><?= $customer->nama_user; ?></h4>
                            <small><?= $customer->email; ?></small>
                        </div>
                    </div>
                    <a href="#" id="openProfileModal">
                        <i class="fa-regular fa-user"></i>
                        Detail Profile
                    </a>
                    <a href="#" id="openLogoutModal">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </div>
            <?php else: ?>
                <div class="guest-profile">
                    <div class="guest-trigger">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="profile-dropdown guest-dropdown">
                        <a href="<?= base_url('login_customer'); ?>" class="guest-link">
                            <span>
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                            Log In
                        </a>
                        <a href="<?= base_url('register'); ?>" class="guest-link">
                            <span>
                                <i class="fa-solid fa-user-plus"></i>
                            </span>
                            Sign Up
                        </a>
                    </div>
                </div>
            <?php endif; ?>
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
<?php $this->load->view('customer/collection', ['produk' => $produk]); ?>
<?php $this->load->view('customer/custom'); ?>
<?php $this->load->view('customer/contact'); ?>

<?php if($this->session->userdata('login') == TRUE && $this->session->userdata('role') == 'customer'): ?>
    <div class="profile-modal" id="profileModal">
        <div class="profile-modal-box">
            <button class="close-profile-modal" id="closeProfileModal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h2>Detail Profile</h2>
            <p>Perbarui data akun dan informasi profile kamu.</p>
            <form action="<?= base_url('update-profile'); ?>" method="post" enctype="multipart/form-data">
                <?php
                    $foto = !empty($customer->foto_profil)
                        ? 'assets/img/profile/' . $customer->foto_profil
                        : 'assets/img/profile-basic.jpg';
                ?>
                <div class="profile-edit-layout">
                    <div class="profile-left">
                        <div class="profile-photo-preview">
                            <img src="<?= base_url($foto); ?>" alt="Profile">
                        </div>
                        <label class="upload-label">Foto Profile</label>
                        <input type="file" name="foto_profil" accept="image/*">
                    </div>
                    <div class="profile-right">
                        <div class="profile-form-grid">
                            <div class="input-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_user" value="<?= $customer->nama_user; ?>">
                            </div>
                            <div class="input-group">
                                <label>No. Telepon</label>
                                <input type="text" name="no_telepon" value="<?= $customer->no_telepon; ?>">
                            </div>
                            <div class="input-group profile-full">
                                <label>Alamat</label>
                                <textarea name="alamat"><?= $customer->alamat; ?></textarea>
                            </div>
                            <div class="profile-full">
                                <button type="submit" class="profile-save-btn">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
    <div class="logout-modal" id="logoutModal">
        <div class="logout-box">
            <div class="logout-icon">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <h3>Logout Account?</h3>
            <p>
                Kamu yakin ingin keluar dari akun Lavéra?
            </p>
            <div class="logout-buttons">

                <button class="cancel-logout" id="closeLogoutModal">
                    Batal
                </button>

                <a href="<?= base_url('logout'); ?>" class="confirm-logout">
                    Ya, Logout
                </a>
            </div>
        </div>
    </div>
<?php $this->load->view('layouts/footer'); ?>


