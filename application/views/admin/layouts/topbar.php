<div class="admin-main">
    <div class="admin-topbar">
        <div>
            <h1><?= isset($page_title) ? $page_title : 'Dashboard'; ?></h1>
            <p>
                <?= isset($page_subtitle) ? $page_subtitle : 'Selamat datang kembali, '.$this->session->userdata('nama_user').' ✨'; ?>
            </p>
        </div>

        <div class="admin-top-right">
            <div class="admin-date">
                <i class="fa-regular fa-calendar"></i>
                <?= date('l, d F Y'); ?>
            </div>

            <div class="top-profile">
                <?php
                    $foto_admin = !empty($admin_profile->foto_profil)
                        ? 'assets/img/profile/' . $admin_profile->foto_profil
                        : 'assets/img/profile-basic.jpg';
                ?>

                <img src="<?= base_url($foto_admin) . '?v=' . time(); ?>" alt="Admin Profile">

                <div class="top-profile-dropdown">
                    <div class="profile-info">
                        <h4><?= $this->session->userdata('nama_user'); ?></h4>
                        <small><?= $this->session->userdata('role'); ?></small>
                    </div>

                    <a href="#" id="openAdminProfileModal">
                        <i class="fa-regular fa-user"></i>
                        Detail Profile
                    </a>

                    <a href="#" id="openLogoutModal">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
       
<?php
$foto_admin = !empty($admin_profile->foto_profil)
    ? 'assets/img/profile/' . $admin_profile->foto_profil
    : 'assets/img/profile-basic.jpg';
?>

<div class="admin-profile-modal" id="adminProfileModal">
    <div class="admin-profile-box">
        <button class="close-admin-profile" id="closeAdminProfileModal">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2>Detail Profile</h2>
        <p>Perbarui informasi akun admin.</p>
        <form action="<?= base_url('admin/update-profile'); ?>" method="post" enctype="multipart/form-data">
            <div class="admin-form-layout">
                <div class="admin-photo-card">
                    <div class="admin-profile-photo">
                        <img src="<?= base_url($foto_admin); ?>">
                    </div>

                    <label>Foto Profile</label>
                    <input type="file" name="foto_profil" accept="image/*">
                </div>

                <div class="admin-form-grid">

                    <div class="admin-input-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_user" value="<?= $admin_profile->nama_user; ?>">
                    </div>

                    <div class="admin-input-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" value="<?= $admin_profile->no_telepon; ?>">
                    </div>

                    <div class="admin-input-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?= $admin_profile->username; ?>">
                    </div>

                    <div class="admin-input-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $admin_profile->email; ?>">
                    </div>

                    <div class="admin-full">
                        <button type="submit" class="admin-save-btn">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>

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
            <a href="<?= base_url('admin/logout'); ?>" class="confirm-logout">
                Ya, Logout
            </a>
        </div>
    </div>
</div>