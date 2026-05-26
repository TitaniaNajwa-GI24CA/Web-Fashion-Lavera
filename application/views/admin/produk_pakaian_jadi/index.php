<div class="admin-page-header">
    <a href="#" class="btn-tambah-produk" id="openProdukModal">
        <i class="fa-solid fa-plus"></i>
        Tambah Produk
    </a>
</div>

<div class="produk-card">
    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari nama produk, model, bahan...">
        </div>

        <select class="filter-status">
            <option>Semua Status</option>
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>

    </div>

    <div class="table-responsive">

        <table class="produk-table">

            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Stok</th>
                     <th>Diskon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($produk as $p): ?>
                <tr>
                    <td>
                        <img
                            src="<?= base_url('assets/img/produk/' . $p->foto_1); ?>"
                            class="produk-img">
                    </td>

                    <td>
                        <div class="produk-info">
                            <h4><?= $p->nama_pakaian; ?></h4>
                            <span>
                                Model:
                                <?= $p->detail_model; ?>
                            </span>
                            <small>
                                Bahan:
                                <?= $p->detail_bahan; ?>
                            </small>
                        </div>
                    </td>

                    <td>
                        <?= $p->ukuran; ?>
                    </td>

                    <td>
                        Rp <?= number_format($p->harga,0,',','.'); ?>
                    </td>

                    <td>
                        <div class="produk-action">
                            <a href="#" class="edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#" class="delete-btn">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <?= $p->stok; ?>
                    </td>
                    <td>
                        <?= $p->diskon_produk; ?>%
                    </td>

                    <td>
                        <span class="status-badge <?= strtolower($p->status_produk); ?>">
                            <?= $p->status_produk; ?>
                        </span>
                    </td>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="produk-modal" id="produkModal">
    <div class="produk-modal-box">
        <button class="close-produk-modal" id="closeProdukModal">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" 
                alt="Lavera Logo"
                class="produk-modal-logo">
            <h2>Tambah Produk</h2>
            <p>Tambahkan koleksi pakaian jadi terbaru Lavéra.</p>
        </div>

        <form action="<?= base_url('admin/simpan-produk-pakaian-jadi'); ?>" 
              method="post"
              enctype="multipart/form-data">
            <div class="produk-modal-grid">
                <div class="produk-input-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_pakaian" required>
                </div>

                <div class="produk-input-group">
                    <label>Ukuran</label>
                    <select name="ukuran" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>

                <div class="produk-input-group">
                    <label>Harga</label>
                    <input type="number" name="harga" required>
                </div>

                <div class="produk-input-group">
                    <label>Stok</label>
                    <input type="number" name="stok" required>
                </div>

                <div class="produk-input-group">
                    <label>Diskon (%)</label>
                    <input type="number" name="diskon_produk" value="0">
                </div>

                <div class="produk-input-group">
                    <label>Status Produk</label>
                    <select name="status_produk">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Detail Model</label>
                    <textarea name="detail_model" required></textarea>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Detail Bahan</label>
                    <textarea name="detail_bahan" required></textarea>
                </div>

                <div class="produk-input-group">
                    <label>Foto 1</label>
                    <input type="file" name="foto_1" required>
                </div>

                <div class="produk-input-group">
                    <label>Foto 2</label>
                    <input type="file" name="foto_2">
                </div>

                <div class="produk-input-group">
                    <label>Foto 3</label>
                    <input type="file" name="foto_3">
                </div>

                <div class="produk-input-group">
                    <label>Foto 4</label>
                    <input type="file" name="foto_4">
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Produk
            </button>
        </form>
    </div>
    </div>

</div>

