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

            <!-- MENU PEMBAYARAN -->
            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-money-check-dollar"></i>
                Pembayaran
            </a>

            <div class="submenu">

                <a href="<?= base_url('kasir/verifikasi-pembayaran'); ?>">
                    <i class="fa-solid fa-clock"></i>
                    Pembayaran DP
                </a>

                <a href="<?= base_url('kasir/pembayaran-berhasil'); ?>">
                    <i class="fa-solid fa-circle-check"></i>
                    Pembayaran Full
                </a>
            </div>

            <!-- MENU PESANAN -->
            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-bag-shopping"></i>
                Pesanan
            </a>

            <div class="submenu">

                <a href="<?= base_url('kasir/pesanan-pakaian-jadi'); ?>">
                    <i class="fa-solid fa-shirt"></i>
                    Pakaian Jadi
                </a>

                <a href="<?= base_url('kasir/pesanan-custom'); ?>">
                    <i class="fa-solid fa-scissors"></i>
                    Pakaian Custom
                </a>

            </div>

            <!-- MENU LAPORAN -->
            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-chart-column"></i>
                Laporan
            </a>
            <div class="submenu">
                <a href="<?= base_url('kasir/laporan-pembayaran'); ?>">
                    <i class="fa-solid fa-file-lines"></i>
                    Laporan Pembayaran
                </a>

                <a href="<?= base_url('kasir/laporan-pendapatan'); ?>">
                    <i class="fa-solid fa-wallet"></i>
                    Laporan Pendapatan
                </a>
            </div>
        </div>

    </div>

    <div class="sidebar-bottom">
        <img src="<?= base_url('assets/img/admin-sidebar.png'); ?>">
    </div>

</div>