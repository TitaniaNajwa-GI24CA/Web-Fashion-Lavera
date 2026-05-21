<!DOCTYPE html>
<html>
<head>
    <title>Login | Lavéra</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
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
<section class="login-page">
    <div class="login-left">
        <img src="<?= base_url('assets/img/login-img-customer.png'); ?>" alt="Login Lavéra">
    </div>

    <div class="login-right">

        <div class="login-form-box">

            <div class="login-logo">
                <img src="<?= base_url('assets/img/logo-lavera.png'); ?>" alt="Logo Lavéra">
            </div>

            <h1>Welcome Back</h1>
            <p class="login-subtitle">
                Masuk untuk melanjutkan pengalaman belanja eleganmu bersama Lavéra.
            </p>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert-error">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('proses-login'); ?>" method="post">

                <div class="input-group">
                    <label>Username / Email</label>
                    <div class="input-box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="login" placeholder="Masukkan username atau email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="#" id="openForgotModal">
                        Lupa Password?
                    </a>
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login Sekarang
                </button>

            </form>

            <div class="auth-link">
                Belum punya akun?
                <a href="<?= base_url('register'); ?>">Daftar sekarang</a>
            </div>

        </div>

    </div>

        <div class="forgot-modal" id="forgotModal">
            <div class="forgot-box">

                <button type="button" class="close-forgot" id="closeForgotModal">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="forgot-icon">
                    <i class="fa-solid fa-key"></i>
                </div>

                <h2>Lupa Password?</h2>
                <p>Masukkan email akun Lavéra kamu untuk proses reset password.</p>

                <form action="<?= base_url('forgot-password'); ?>" method="post">
                    <div class="input-group">
                        <label>Email</label>
                        <div class="input-box">
                            <i class="fa-regular fa-envelope"></i>

                            <input type="email"
                                name="email"
                                placeholder="Masukkan email akun"
                                required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password Baru</label>
                        <div class="input-box">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password"
                                name="password_baru"
                                placeholder="Masukkan password baru"
                                required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Konfirmasi Password</label>
                        <div class="input-box">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password"
                                name="konfirmasi_password"
                                placeholder="Ulangi password baru"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn">
                        Update Password
                    </button>

                </form>
            </div>
        </div>

</section>
<script src="<?= base_url('assets/js/pop-up.js'); ?>"></script>
</body>
</html>