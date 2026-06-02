<!DOCTYPE html>
<html>
<head>
    <title>Register Customer | Lavéra</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<section class="auth-page register-page">

    <div class="auth-card">

        <div class="auth-logo">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>" alt="Lavéra Logo">
        </div>

        <h2>Buat Akun Baru</h2>
        <p>Daftar untuk mulai berbelanja dan request custom outfit.</p>

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

        <form action="<?= base_url('proses-register'); ?>" method="post">

            <div class="form-grid">

                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <div class="input-box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="nama_user" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Username</label>
                    <div class="input-box">
                        <i class="fa-solid fa-at"></i>
                        <input type="text" name="username" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <div class="input-box">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" placeholder="Masukkan email aktif" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>No. Telepon</label>
                    <div class="input-box">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" name="no_telepon" placeholder="Masukkan nomor telepon" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Buat password" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="konfirmasi_password" placeholder="Ulangi password" required>
                    </div>
                </div>

            </div>

            <div class="input-group">
                <label>Alamat</label>
                <div class="input-box textarea-box">
                    <i class="fa-solid fa-location-dot"></i>
                    <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
                </div>
            </div>

            <button type="submit" class="auth-btn">
                <i class="fa-solid fa-user-plus"></i>
                Daftar Sekarang
            </button>

        </form>

        <div class="auth-link">
            Sudah punya akun?
            <a href="<?= base_url('login_customer'); ?>">Login di sini</a>
        </div>

    </div>

</section>

<?php if($this->session->flashdata('success')): ?>
<div class="success-modal" id="successModal">
    <div class="success-box">
        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <h3>Berhasil!</h3>
        <p><?= $this->session->flashdata('success'); ?></p>
    </div>
</div>
<?php endif; ?>

<script>
    setTimeout(function(){
        const modal = document.getElementById('successModal');
        if(modal){
            modal.style.display = 'none';
        }
    }, 2200);
</script>

</body>
</html>