<?php $this->load->view('layouts/header'); ?>

<section class="cart-page">
    <div class="cart-container">

        <div class="cart-page-header">
            <div>
                <p>Lavéra Cart</p>
                <h1>Keranjang Belanja</h1>
                <span>Produk pakaian jadi yang kamu pilih.</span>
            </div>

            <a href="<?= base_url('collection'); ?>" class="cart-back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Lanjut Belanja
            </a>
        </div>

        <?php if(!empty($cart_items)): ?>

            <div class="cart-layout">

                <div class="cart-list">
                    <?php
                        $grand_total = 0;
                    ?>

                    <?php foreach($cart_items as $c): ?>
                        <?php
                            $harga_diskon = $c->harga - ($c->harga * $c->diskon_produk / 100);
                            $subtotal = $harga_diskon * $c->jumlah;
                            $grand_total += $subtotal;
                        ?>

                        <div class="cart-item-card">
                            <img src="<?= base_url('assets/img/produk/'.$c->foto_4); ?>" class="cart-item-img">
                            <div class="cart-item-info">
                                <h3><?= $c->nama_pakaian; ?></h3>
                                <p>Ukuran: <?= $c->ukuran; ?></p>
                                <span>Stok: <?= $c->stok; ?> pcs</span>

                                <h4>
                                    Rp <?= number_format($harga_diskon,0,',','.'); ?>
                                </h4>
                                <a href="<?= base_url('pesanan/form/'.$c->id_pakaian_jadi); ?>" class="checkout-item-btn">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    Checkout Produk Ini
                                </a>
                            </div>

                            <form action="<?= base_url('cart/update'); ?>" method="post" class="cart-qty-form">
                                <div class="cart-qty-control">
                                    <a href="<?= base_url('cart/minus/'.$c->id_keranjang); ?>" class="qty-btn">
                                        <i class="fa-solid fa-minus"></i>
                                    </a>

                                    <span class="qty-number"><?= $c->jumlah; ?></span>

                                    <a href="<?= base_url('cart/plus/'.$c->id_keranjang); ?>" class="qty-btn">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </div>
                            </form>

                            <div class="cart-item-total">
                                <span>Subtotal</span>
                                <b>Rp <?= number_format($subtotal,0,',','.'); ?></b>

                                <a href="<?= base_url('cart/delete/'.$c->id_keranjang); ?>"
                                   onclick="return confirm('Hapus produk ini dari keranjang?')">
                                    <i class="fa-solid fa-trash"></i>
                                    Hapus
                                </a>
                            </div>

                        </div>

                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <h3>Ringkasan Belanja</h3>

                    <div class="summary-row">
                        <span>Total Produk</span>
                        <b><?= count($cart_items); ?> item</b>
                    </div>

                    <div class="summary-row">
                        <span>Total Belanja</span>
                        <b>Rp <?= number_format($grand_total,0,',','.'); ?></b>
                    </div>

                     <a href="<?= base_url('pesanan/form'); ?>" class="checkout-cart-btn">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Checkout Semua
                    </a>

                    <a href="<?= base_url('cart/clear'); ?>"
                       onclick="return confirm('Kosongkan semua keranjang?')"
                       class="clear-cart-btn">
                        Kosongkan Keranjang
                    </a>
                </div>

            </div>

        <?php else: ?>

            <div class="cart-empty-page">
                <i class="fa-solid fa-bag-shopping"></i>
                <h3>Keranjang masih kosong</h3>
                <p>Yuk pilih outfit favoritmu di koleksi Lavéra.</p>

                <a href="<?= base_url('collection'); ?>">
                    Mulai Belanja
                </a>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>