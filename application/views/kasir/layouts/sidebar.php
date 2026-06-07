<div class="admin-sidebar">
    <div>
        <div class="sidebar-logo">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>">
        </div>

        <div class="sidebar-menu">

            <a href="<?= base_url('kasir/dashboard'); ?>" class="active">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-money-check-dollar"></i>
                Pembayaran
            </a>

            <div class="submenu">
                <a href="<?= base_url('kasir/pembayaran-pakaian-jadi'); ?>">
                    <i class="fa-solid fa-shirt"></i>
                    Pakaian Jadi
                </a>

                <a href="<?= base_url('kasir/pembayaran-dp-custom'); ?>">
                    <i class="fa-solid fa-coins"></i>
                    DP Custom
                </a>

                <a href="<?= base_url('kasir/pelunasan-custom'); ?>">
                    <i class="fa-solid fa-wallet"></i>
                    Pelunasan Custom
                </a>
            </div>
        </div>
    </div>

    <div class="sidebar-bottom">
        <img src="<?= base_url('assets/img/admin-sidebar.png'); ?>">
    </div>
</div>