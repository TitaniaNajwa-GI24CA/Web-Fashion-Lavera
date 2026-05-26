<!DOCTYPE html>
<html>
<head>
    <title>Staff Login | Lavéra</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<section class="staff-login-page">
    <div class="staff-right">
        <div class="staff-login-card">
            <div class="staff-icon">
                <i class="fa-regular fa-user"></i>
            </div>
            <h1>Staff Login</h1>
            <p>Silakan masukkan username dan password untuk masuk ke sistem.</p>
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
            <form action="<?= base_url('proses-staff-login'); ?>" method="post">

                <div class="staff-input-group">
                    <label>Username</label>
                    <div class="staff-input-box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="login" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="staff-input-group">
                    <label>Password</label>
                    <div class="staff-input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="staff-login-btn">
                    <i class="fa-solid fa-lock"></i>
                    Login
                </button>

                <div class="staff-divider">
                    <span></span>
                    <p>atau</p>
                    <span></span>
                </div>

                <a href="<?= base_url('admin/register-staff'); ?>" class="staff-register-btn">
                    <i class="fa-solid fa-user-plus"></i>
                    Registrasi
                </a>
            </form>
        </div>
    </div>
</section>

</body>
</html>