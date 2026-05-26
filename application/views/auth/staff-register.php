<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Staff | Lavéra</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<section class="staff-regist-page">
    <div class="staff-regist-wrapper">
        <div class="staff-regist-left">
            <img src="<?= base_url('assets/img/staff-regist-img.png'); ?>" alt="Staff Lavéra">
        </div>
        <div class="staff-regist-right">
            <h1>Registrasi Staff</h1>
            <p>Lengkapi data berikut untuk membuat akun staff baru.</p>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert-error">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/proses-register-staff'); ?>" method="post">

                <div class="staff-regist-grid">

                    <div class="staff-input-group">
                        <label>Nama Lengkap</label>
                        <div class="staff-input-box">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="nama_user" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <div class="staff-input-group">
                        <label>Username</label>
                        <div class="staff-input-box">
                            <i class="fa-solid fa-at"></i>
                            <input type="text" name="username" placeholder="Masukkan username" required>
                        </div>
                    </div>

                    <div class="staff-input-group">
                        <label>Email</label>
                        <div class="staff-input-box">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" placeholder="Masukkan email" required>
                        </div>
                    </div>

                    <div class="staff-input-group">
                        <label>No. Telepon</label>
                        <div class="staff-input-box">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="no_telepon" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>

                    <div class="staff-input-group">
                        <label>Password</label>
                        <div class="staff-input-box">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="staff-input-group">
                        <label>Konfirmasi Password</label>
                        <div class="staff-input-box">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="konfirmasi_password" placeholder="Konfirmasi password" required>
                        </div>
                    </div>

                    <div class="staff-input-group staff-full">
                        <label>Role / Jabatan</label>
                        <div class="staff-input-box">
                            <i class="fa-solid fa-user-tie"></i>
                            <select name="role" required>
                                <option value="">Pilih role staff</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>
                    </div>

                </div>

                <button type="submit" class="staff-regist-btn">
                    <i class="fa-solid fa-user-plus"></i>
                    Daftarkan Staff
                </button>

                <a href="<?= base_url('staff-login'); ?>" class="back-dashboard">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Halaman Login Admin
                </a>

            </form>

        </div>

    </div>

</section>

</body>
</html>