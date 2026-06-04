<div class="admin-page-header">
</div>

<div class="produk-card">
    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchProduk" placeholder="Cari pesanan...">
        </div>

        <select class="filter-status" id="filterStatus">
            <option value="">Semua Status</option>
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
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
                <tr class="produk-row" data-status="<?= $p->status_produk; ?>" data-nama="<?= strtolower($p->nama_pakaian); ?>">
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

                    <td>
                            <a href="#"
                                class="edit-btn open-edit-produk-modal"
                                data-id="<?= $p->id_pakaian_jadi; ?>"
                                data-nama="<?= htmlspecialchars($p->nama_pakaian, ENT_QUOTES); ?>"
                                data-ukuran="<?= $p->ukuran; ?>"
                                data-harga="<?= $p->harga; ?>"
                                data-stok="<?= $p->stok; ?>"
                                data-diskon="<?= $p->diskon_produk; ?>"
                                data-status="<?= $p->status_produk; ?>"
                                data-model="<?= htmlspecialchars($p->detail_model, ENT_QUOTES); ?>"
                                data-bahan="<?= htmlspecialchars($p->detail_bahan, ENT_QUOTES); ?>"
                                data-foto1="<?= $p->foto_1; ?>"
                                data-foto2="<?= $p->foto_2; ?>"
                                data-foto3="<?= $p->foto_3; ?>"
                                data-foto4="<?= $p->foto_4; ?>">
                                    <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#"
                                class="delete-btn open-delete-modal"
                                data-url="<?= base_url('admin/hapus-produk-pakaian-jadi/' . $p->id_pakaian_jadi); ?>">
                                    <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
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

    <div class="produk-modal" id="editProdukModal">
    <div class="produk-modal-box">
        <button class="close-produk-modal" id="closeEditProdukModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" 
                 alt="Lavera Logo"
                 class="produk-modal-logo">

            <h2>Edit Produk</h2>
            <p>Perbarui data produk pakaian jadi Lavéra.</p>
        </div>

        <form action="<?= base_url('admin/update-produk-pakaian-jadi'); ?>" 
              method="post"
              enctype="multipart/form-data">

            <input type="hidden" name="id_pakaian_jadi" id="edit_id_pakaian_jadi">

            <div class="produk-modal-grid">

                <div class="produk-input-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_pakaian" id="edit_nama_pakaian" required>
                </div>

                <div class="produk-input-group">
                    <label>Ukuran</label>
                    <select name="ukuran" id="edit_ukuran" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>

                <div class="produk-input-group">
                    <label>Harga</label>
                    <input type="number" name="harga" id="edit_harga" required>
                </div>

                <div class="produk-input-group">
                    <label>Stok</label>
                    <input type="number" name="stok" id="edit_stok" required>
                </div>

                <div class="produk-input-group">
                    <label>Diskon (%)</label>
                    <input type="number" name="diskon_produk" id="edit_diskon_produk" value="0">
                </div>

                <div class="produk-input-group">
                    <label>Status Produk</label>
                    <select name="status_produk" id="edit_status_produk">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Detail Model</label>
                    <textarea name="detail_model" id="edit_detail_model" required></textarea>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Detail Bahan</label>
                    <textarea name="detail_bahan" id="edit_detail_bahan" required></textarea>
                </div>

                <div class="produk-input-group">
                    <label>Foto 1 Baru</label>
                    <input type="file" name="foto_1" accept="image/*">
                    <small class="old-file-text" id="old_foto_1"></small>
                </div>

                <div class="produk-input-group">
                    <label>Foto 2 Baru</label>
                    <input type="file" name="foto_2" accept="image/*">
                    <small class="old-file-text" id="old_foto_2"></small>
                </div>

                <div class="produk-input-group">
                    <label>Foto 3 Baru</label>
                    <input type="file" name="foto_3" accept="image/*">
                    <small class="old-file-text" id="old_foto_3"></small>
                </div>

                <div class="produk-input-group">
                    <label>Foto 4 Baru</label>
                    <input type="file" name="foto_4" accept="image/*">
                    <small class="old-file-text" id="old_foto_4"></small>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Update Produk
            </button>
        </form>
    </div>
</div>

<div class="delete-modal" id="deleteModal">
    <div class="delete-box">

        <div class="delete-icon">
            <i class="fa-solid fa-trash"></i>
        </div>
        <h3>Hapus Data?</h3>
        <p>
            Data yang sudah dihapus tidak dapat dikembalikan.
            Apakah kamu yakin ingin menghapus data ini?
        </p>
        <div class="delete-buttons">
            <button type="button" class="cancel-delete" id="closeDeleteModal">
                Batal
            </button>
            <a href="#" class="confirm-delete" id="confirmDeleteBtn">
                Ya, Hapus
            </a>
        </div>
    </div>
</div>
</div>

