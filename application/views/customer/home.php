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

            <div class="history-dropdown-box">
                <div class="cart-box" id="historyToggle">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="cart-count"><?= count($riwayat_pakaian) + count($riwayat_custom); ?></span>
                </div>

                <div class="history-dropdown" id="historyDropdown">
                    <div class="history-dropdown-header">
                        <div>
                            <h4>Riwayat Pesanan</h4>
                            <small>Pesanan terbaru kamu</small>
                        </div>

                        <div class="history-header-actions">
                            <button type="button" onclick="window.location.href='<?= base_url('riwayat-pesanan') ?>'" class="history-expand-link">
                                <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                            </button>

                            <button type="button" id="closeHistoryDropdown" class="history-close-btn">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="history-mini-tabs">
                        <button class="history-mini-tab active" data-target="miniReadyOrder">
                            Pakaian Jadi
                        </button>
                        <button class="history-mini-tab" data-target="miniCustomOrder">
                            Custom
                        </button>
                    </div>

                    <div class="history-mini-content active" id="miniReadyOrder">
                        <?php if(!empty($riwayat_pakaian)): ?>
                            <?php foreach(array_slice($riwayat_pakaian, 0, 3) as $r): ?>
                                <a href="<?= base_url('pesanan/detail/'.$r->id_pesanan); ?>" class="history-mini-item">
                                    <div>
                                        <h5><?= $r->kode_pesanan; ?></h5>
                                        <span><?= date('d M Y', strtotime($r->tanggal_pesanan)); ?></span>
                                    </div>

                                    <small><?= $r->status_pesanan; ?></small>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="history-empty">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <p>Belum ada pesanan pakaian jadi.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="history-mini-content" id="miniCustomOrder">
                        <?php if(!empty($riwayat_custom)): ?>
                            <?php foreach(array_slice($riwayat_custom, 0, 3) as $r): ?>
                                <a href="<?= base_url('pesanan/detail/'.$r->id_pesanan); ?>" class="history-mini-item">
                                    <div>
                                        <h5><?= $r->kode_pesanan; ?></h5>
                                        <span><?= date('d M Y', strtotime($r->tanggal_pesanan)); ?></span>
                                    </div>

                                    <small><?= $r->status_pesanan; ?></small>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="history-empty">
                                <i class="fa-solid fa-scissors"></i>
                                <p>Belum ada request custom.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="notification-box">
                <div class="cart-box" id="notificationToggle">
                    <i class="fa-regular fa-bell"></i>
                    <?php if(($jumlah_notifikasi ?? 0) > 0): ?>
                        <span class="cart-count">
                            <?= $jumlah_notifikasi; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="notification-dropdown" id="notificationDropdown">
                    <div class="notification-header">
                        <h4>Notifikasi</h4>
                        <a href="<?= base_url('notifikasi'); ?>">
                            Lihat Semua
                        </a>

                        <button type="button" id="closeHistoryDropdown" class="history-close-btn">
                                <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <?php if(!empty($notifikasi)): ?>
                        <?php foreach($notifikasi as $n): ?>
                            <a href="#"
                            class="notification-item">
                                <div class="notif-dot <?= $n->status_baca == 'belum_dibaca' ? 'active' : ''; ?>"></div>
                                <div>
                                    <h5>
                                        <?= $n->judul_notifikasi; ?>
                                    </h5>
                                    <p>
                                        <?= $n->pesan_notifikasi; ?>
                                    </p>
                                </div>

                            </a>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="notification-empty">

                            <i class="fa-regular fa-bell-slash"></i>

                            <p>
                                Belum ada notifikasi.
                            </p>

                        </div>
                    <?php endif; ?>
                </div>
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
<?php $this->load->view('customer/custom', ['custom_db' => $custom_db]); ?>
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


