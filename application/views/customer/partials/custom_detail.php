<section class="custom-detail-page">
    <div class="custom-detail-hero" data-aos="fade-up">
        <div class="custom-detail-text">
            <p><?= $custom['label']; ?></p>
            <h1><?= $custom['title']; ?></h1>
            <span><?= $custom['desc']; ?></span>

            <a href="#" class="hero-custom-btn">
                Custom This Style
            </a>

            <div class="custom-detail-feature-list">
                <?php foreach($custom['features'] as $feature): ?>
                    <div class="custom-detail-feature">
                        <i class="<?= $feature['icon']; ?>"></i>
                        <small><?= $feature['text']; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="custom-detail-image">
            <img src="<?= base_url('assets/img/' . $custom['hero_img']); ?>" alt="<?= $custom['title']; ?>">
        </div>
    </div>

    <div class="custom-detail-reference-header">
        <span></span>
        <h2><?= $custom['reference_title']; ?></h2>
        <span></span>
    </div>

    <div class="custom-detail-reference-grid" data-aos="zoom-in">
        <?php foreach ($custom['references'] as $ref): ?>
            <div class="custom-detail-reference-card">
                <img src="<?= base_url('assets/img/' . $ref['img']); ?>" alt="<?= $ref['name']; ?>">
                <div class="custom-detail-reference-info">
                    <h3><?= $ref['name']; ?></h3>
                    <p><?= $ref['desc']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="custom-detail-fabric-box" data-aos="fade-up">
        <div class="custom-detail-fabric-text">
            <h2><?= $custom['fabric_title']; ?></h2>
            <a href="#" class="fabric-price-btn" id="openFabricPrice">
                <i class="fa-solid fa-table-list"></i>
                Lihat Price List Bahan
            </a>
        </div>

        <div class="custom-detail-fabric-grid">
            <?php foreach ($custom['fabrics'] as $fabric): ?>
                <div class="fabric-card">
                    <img src="<?= base_url('assets/img/' . $fabric['img']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="custom-detail-bottom-button">
        <a href="#" class="custom-detail-consult-btn">
            <i class="fa-brands fa-whatsapp"></i>
            Konsultasi dan Wujudkan Outfit Impianmu
        </a>
    </div>

</section>

<div class="fabric-price-modal" id="fabricPriceModal">
    <div class="fabric-price-box">

        <span class="fabric-price-close" id="closeFabricPrice">&times;</span>

        <h2>Price List Bahan</h2>
        <p>Estimasi harga berdasarkan jenis bahan dan ukuran.</p>

        <div class="fabric-table-wrap">
            <table class="fabric-price-table">
                <thead>
                    <tr>
                        <th>Bahan</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($custom['price_list'] as $price): ?>
                        <tr>
                            <td><?= $price['fabric']; ?></td>
                            <td><?= $price['s']; ?></td>
                            <td><?= $price['m']; ?></td>
                            <td><?= $price['l']; ?></td>
                            <td><?= $price['xl']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <small>*Harga masih estimasi dan dapat berubah sesuai desain, detail, dan request custom.</small>

    </div>
</div>

<script src="<?= base_url('assets/js/custom.js'); ?>"></script>