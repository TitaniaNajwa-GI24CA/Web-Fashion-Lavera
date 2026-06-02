<?php $this->load->view('layouts/header'); ?>
<section class="collection-page" id="collection" data-aos="fade-up">

    <div class="collection-header">
        <p> New Collection </p>
        <h1>Discover Our Latest Pieces</h1>
    </div>

    <div class="product-grid" data-aos="zoom-in">

        <?php
        $products = [
            [
                'name' => 'Luna Dress',
                'price' => 'IDR 565.000',
                'imgs' => ['luna-1.png', 'luna-2.png', 'luna-3.png', 'luna-4.png'],
                'material' => 'Premium soft cotton blend dengan tekstur halus, nyaman, dan jatuh elegan.',
                'model' => 'Midi dress dengan potongan feminine, belt waist, dan detail clean modern.'
            ],
            [
                'name' => 'Elara Top',
                'price' => 'IDR 425.000',
                'imgs' => ['elara-1.png', 'elara-2.png', 'elara-3.png', 'elara-4.png'],
                'material' => 'Silky blouse fabric yang ringan, lembut, dan nyaman dipakai seharian.',
                'model' => 'Blouse soft pink dengan cutting loose elegant dan detail button front.'
            ],
            [
                'name' => 'Naia Set',
                'price' => 'IDR 725.000',
                'imgs' => ['naia-1.png', 'naia-2.png', 'naia-3.png', 'naia-4.png'],
                'material' => 'Premium suit fabric, adem, rapi, dan tidak mudah kusut.',
                'model' => 'Set blazer dan celana warna lavender dengan potongan modern office look.'
            ],
            [
                'name' => 'Aurelia Outer',
                'price' => 'IDR 375.000',
                'imgs' => ['aurelia-1.png', 'aurelia-2.png', 'aurelia-3.png', 'aurelia-4.png'],
                'material' => 'Light outer fabric yang flowy, ringan, dan nyaman untuk layering.',
                'model' => 'Outer mint dengan cutting loose, front drape, dan lengan clean casual.'
            ],
            [
                'name' => 'Celine Oneset',
                'price' => 'IDR 565.000',
                'imgs' => ['celine-1.png', 'celine-2.png', 'celine-3.png', 'celine-4.png'],
                'material' => 'Premium semi-wool blend, lembut, tebal sedang, dan jatuh rapi.',
                'model' => 'Sleeveless oneset dengan belt waist dan look formal feminine.'
            ],
            [
                'name' => 'Aria Dress',
                'price' => 'IDR 525.000',
                'imgs' => ['aria-1.png', 'aria-2.png', 'aria-3.png', 'aria-4.png'],
                'material' => 'Soft flowy fabric dengan tekstur ringan dan nyaman.',
                'model' => 'Dress terracotta dengan potongan wrap dan detail belt elegan.'
            ],
            [
                'name' => 'Lea T-Shirt',
                'price' => 'IDR 225.000',
                'imgs' => ['lea-1.png', 'lea-2.png', 'lea-3.png', 'lea-4.png'],
                'material' => 'Cotton combed premium yang adem, stretch ringan, dan halus.',
                'model' => 'T-shirt biru muda dengan cutting modern dan aksen side knot.'
            ],
            [
                'name' => 'Mira Blouse',
                'price' => 'IDR 425.000',
                'imgs' => ['mira-1.png', 'mira-2.png', 'mira-3.png', 'mira-4.png'],
                'material' => 'Satin silk look, ringan, glossy soft, dan nyaman.',
                'model' => 'Blouse navy dengan detail button dan potongan formal casual.'
            ],
            [
                'name' => 'Sienna Dress',
                'price' => 'IDR 575.000',
                'imgs' => ['sienna-1.png', 'sienna-2.png', 'sienna-3.png', 'sienna-4.png'],
                'material' => 'Soft satin premium dengan efek jatuh mewah.',
                'model' => 'Dress kuning pastel dengan neckline drape dan silhouette elegant.'
            ],
            [
                'name' => 'Talia Set',
                'price' => 'IDR 675.000',
                'imgs' => ['talia-1.png', 'talia-2.png', 'talia-3.png', 'talia-4.png'],
                'material' => 'Premium rayon blend, ringan, tidak menerawang, dan nyaman.',
                'model' => 'Set coklat modern dengan kemeja relaxed dan wide pants.'
            ],
        ];
        ?>

        <?php foreach ($products as $product): ?>
            <?php
            $imgs = array_map(function($img){
                return base_url('assets/img/' . $img);
            }, $product['imgs']);
            ?>

            <div class="product-card"
                data-name="<?= $product['name']; ?>"
                data-price="<?= $product['price']; ?>"
                data-imgs='<?= json_encode($imgs); ?>'
                data-material="<?= $product['material']; ?>"
                data-model="<?= $product['model']; ?>">

                <div class="product-img">
                    <img src="<?= base_url('assets/img/' . $product['imgs'][0]); ?>" alt="<?= $product['name']; ?>">

                    <button class="love-btn" type="button">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>

                <div class="product-info">
                    <h3><?= $product['name']; ?></h3>
                    <p><?= $product['price']; ?></p>
                    <button class="detail-btn" type="button">Detail Product</button>
                </div>
            </div>
        <?php endforeach; ?>

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

            <p class="label">Detail Bahan</p>
            <p id="modalMaterial"></p>

            <p class="label">Model</p>
            <p id="modalModel"></p>

            <p class="label">Ukuran</p>
            <div class="size-options">
                <button>S</button>
                <button>M</button>
                <button>L</button>
                <button>XL</button>
            </div>

            <div class="modal-actions">
                <button class="order-btn">Pesan Sekarang</button>
                <button class="cart-btn">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Keranjang
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/collection.js'); ?>"></script>

<?php $this->load->view('layouts/footer'); ?>