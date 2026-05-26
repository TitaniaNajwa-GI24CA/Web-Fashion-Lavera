<div class="admin-sidebar">
    <div>
        <div class="sidebar-logo">
            <img src="<?= base_url('assets/img/logo-lavera.png'); ?>">
        </div>
        <div class="sidebar-menu">
            <a href="<?= base_url('admin/dashboard'); ?>" class="active">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

           <!-- MENU PRODUK -->
            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-box"></i>
                Produk
            </a>

            <div class="submenu">

                <a href="<?= base_url('admin/produk-pakaian-jadi'); ?>">
                    <i class="fa-solid fa-shirt"></i>
                    Pakaian Jadi
                </a>

                <a href="<?= base_url('admin/kategori-custom'); ?>">
                    <i class="fa-solid fa-tags"></i>
                    Kategori Custom
                </a>

            </div>

            <a href="#">
                <i class="fa-solid fa-scissors"></i>
                Request Custom
            </a>

            <!-- MENU PESANAN -->
            <a href="javascript:void(0)" class="has-submenu">
                <i class="fa-solid fa-bag-shopping"></i>
                Pesanan
            </a>

            <div class="submenu">

                <a href="<?= base_url('admin/pesanan-pakaian-jadi'); ?>">
                    <i class="fa-solid fa-shirt"></i>
                    Pakaian Jadi
                </a>

                <a href="<?= base_url('admin/pesanan-custom'); ?>">
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

                <a href="<?= base_url('admin/laporan-penjualan-pakaian-jadi'); ?>">
                    <i class="fa-solid fa-file-lines"></i>
                    Penjualan Pakaian Jadi
                </a>

                <a href="<?= base_url('admin/laporan-penjualan-custom'); ?>">
                    <i class="fa-solid fa-file-invoice"></i>
                    PenjualanPakaian Custom
                </a>
            </div>

            <a href="#">
                <i class="fa-solid fa-gear"></i>
                Pengaturan
            </a>
        </div>
    </div>
    <div class="sidebar-bottom">
        <img src="<?= base_url('assets/img/admin-sidebar.png'); ?>">
    </div>
</div>