<?php $this->load->view('layouts/header'); ?>

<section class="collection-page" id="collection" data-aos="fade-up">

    <div class="collection-header">
        <p>New Collection</p>
        <h1>Discover Our Latest Pieces</h1>
    </div>

    <div class="product-grid" data-aos="zoom-in">
        <?php if(!empty($produk)): ?>
            <?php foreach ($produk as $p): ?>
                <?php
                    $imgs = [];
                    if(!empty($p->foto_1)){
                        $imgs[] = base_url('assets/img/produk/' . $p->foto_1);
                    }
                    if(!empty($p->foto_2)){
                        $imgs[] = base_url('assets/img/produk/' . $p->foto_2);
                    }
                    if(!empty($p->foto_3)){
                        $imgs[] = base_url('assets/img/produk/' . $p->foto_3);
                    }
                    if(!empty($p->foto_4)){
                        $imgs[] = base_url('assets/img/produk/' . $p->foto_4);
                    }
                    if(empty($imgs)){
                        $imgs[] = base_url('assets/img/default-product.png');
                    }

                    $ukuran_stok = [];
                    if(!empty($p->ukuran_stok)){
                        foreach($p->ukuran_stok as $us){
                            $ukuran_stok[] = [
                                'id_pakaian_jadi' => $us->id_pakaian_jadi,
                                'ukuran' => $us->ukuran,
                                'stok' => $us->stok
                            ];
                        }
                    }
                ?>

                <div class="product-card"
                    data-id="<?= $p->id_pakaian_jadi; ?>"
                    data-name="<?= htmlspecialchars($p->nama_pakaian, ENT_QUOTES); ?>"
                    data-price="IDR <?= number_format($p->harga, 0, ',', '.'); ?>"
                    data-harga="<?= $p->harga; ?>"
                    data-diskon="<?= $p->diskon_produk; ?>"
                    data-ukuran-stok='<?= json_encode($ukuran_stok); ?>'
                    data-imgs='<?= json_encode($imgs); ?>'
                    data-material="<?= htmlspecialchars($p->detail_bahan, ENT_QUOTES); ?>"
                    data-model="<?= htmlspecialchars($p->detail_model, ENT_QUOTES); ?>">

                    <div class="product-img">

                        <img src="<?= $imgs[0]; ?>" alt="<?= htmlspecialchars($p->nama_pakaian, ENT_QUOTES); ?>">

                        <?php if($p->diskon_produk > 0): ?>
                            <span class="discount-badge">
                                Diskon <?= $p->diskon_produk; ?>%
                            </span>
                        <?php endif; ?>

                    </div>

                    <div class="product-info">

                        <h3><?= $p->nama_pakaian; ?></h3>

                        <p>
                            IDR <?= number_format($p->harga, 0, ',', '.'); ?>
                        </p>

                        <button class="detail-btn" type="button">
                            Detail Product
                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-product">
                <p>Belum ada produk pakaian jadi yang tersedia.</p>
            </div>
        <?php endif; ?>

    </div>

</section>

<div class="modal" id="productModal">
    <div class="modal-box">
        <span class="close-modal">&times;</span>
        <div class="modal-img slider">
            <img id="modalImg" src="" alt="">
            <div class="slider-dots" id="sliderDots"></div>

        </div>

        <div class="modal-detail">
            <h2 id="modalName"></h2>
            <h3 id="modalPrice"></h3>
            <p class="modal-discount-info" id="modalDiscountInfo"></p>
            <p class="label">Detail Bahan</p>
            <p id="modalMaterial"></p>
            <p class="label">Model</p>
            <p id="modalModel"></p>
            <p class="label">Ukuran</p>
            <div class="size-options">
                <button type="button" class="size-btn" data-size="S">S</button>
                <button type="button" class="size-btn" data-size="M">M</button>
                <button type="button" class="size-btn" data-size="L">L</button>
                <button type="button" class="size-btn" data-size="XL">XL</button>
            </div>

            <p id="sizeStockInfo" class="size-stock-info">
                Pilih ukuran untuk melihat stok.
            </p>

            <div class="modal-actions">

                <a href="#" id="orderLink" class="order-btn">
                    <i class="fa-solid fa-receipt"></i>
                    Pesan Sekarang
                </a>

                <a href="#" id="cartLink" class="cart-btn">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Keranjang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const baseUrl = "<?= base_url(); ?>";
</script>

<script src="<?= base_url('assets/js/collection.js'); ?>"></script>

<?php $this->load->view('layouts/footer'); ?>