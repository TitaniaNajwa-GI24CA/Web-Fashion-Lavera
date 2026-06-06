<div class="admin-page-header">
    <a href="#" class="btn-tambah-produk" id="openCustomModal">
        <i class="fa-solid fa-plus"></i>
        Tambah Kategori
    </a>
</div>

<div class="produk-card">

    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchCustom" placeholder="Cari kategori custom...">
        </div>

        <select class="filter-status" id="filterCustomStatus">
            <option>Semua Status</option>
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Referensi</th>
                    <th>Kategori Custom</th>
                    <th>Deskripsi</th>
                    <th>Gambar Bahan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($custom as $c): ?>
                    <tr class="produk-row" data-status="<?= $c->status_custom; ?>" data-kategori="<?= strtolower($c->kategori_custom); ?>">
                        <td>
                            <img src="<?= base_url('assets/img/custom/' . $c->gambar_referensi); ?>" class="produk-img">
                        </td>

                        <td>
                            <div class="produk-info">
                                <h4><?= $c->kategori_custom; ?></h4>
                            </div>
                        </td>

                        <td><?= $c->deskripsi_referensi; ?></td>

                        <td>
                            <img src="<?= base_url('assets/img/custom/' . $c->gambar_bahan); ?>" class="produk-img">
                        </td>

                        <td>
                            <span class="status-badge <?= strtolower($c->status_custom); ?>">
                                <?= $c->status_custom; ?>
                            </span>
                        </td>

                        <td>
                            <div class="produk-action">
                                <a href="#"
                                    class="edit-btn open-edit-modal"
                                    data-id="<?= $c->id_custom; ?>"
                                    data-kategori="<?= htmlspecialchars($c->kategori_custom, ENT_QUOTES); ?>"
                                    data-deskripsi="<?= htmlspecialchars($c->deskripsi_referensi, ENT_QUOTES); ?>"
                                    data-status="<?= $c->status_custom; ?>"
                                    data-gambar-referensi="<?= $c->gambar_referensi; ?>"
                                    data-gambar-bahan="<?= $c->gambar_bahan; ?>">
                                        <i class="fa-solid fa-pen"></i>
                                </a>

                                <a href="#"
                                   class="delete-btn open-delete-modal"
                                   data-url="<?= base_url('admin/kategori_custom/hapus/' . $c->id_custom); ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div>

<div class="produk-modal" id="customModal">
    <div class="produk-modal-box">

        <button class="close-produk-modal" id="closeCustomModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Tambah Kategori Custom</h2>
            <p>Tambahkan kategori custom outfit terbaru Lavéra.</p>
        </div>

        <form action="<?= base_url('admin/simpan-kategori-custom'); ?>" method="post" enctype="multipart/form-data">

            <div class="produk-modal-grid">

                <div class="produk-input-group">
                    <label>Kategori Custom</label>
                    <input type="text" name="kategori_custom" required>
                </div>

                <div class="produk-input-group">
                    <label>Status Custom</label>
                    <select name="status_custom" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Deskripsi Referensi</label>
                    <textarea name="deskripsi_referensi" required></textarea>
                </div>

                <div class="produk-input-group">
                    <label>Gambar Referensi</label>
                    <input type="file" name="gambar_referensi" accept="image/*" required>
                </div>

                <div class="produk-input-group">
                    <label>Gambar Bahan</label>
                    <input type="file" name="gambar_bahan" accept="image/*" required>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Kategori
            </button>

        </form>

    </div>
</div>

<div class="produk-modal" id="editCustomModal">
    <div class="produk-modal-box">
        <button class="close-produk-modal" id="closeEditCustomModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Edit Kategori Custom</h2>
            <p>Perbarui data kategori custom outfit Lavéra.</p>
        </div>

        <form action="<?= base_url('admin/update-kategori-custom'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_custom" id="edit_id_custom">
            <div class="produk-modal-grid">
                <div class="produk-input-group">
                    <label>Kategori Custom</label>
                    <input type="text" name="kategori_custom" id="edit_kategori_custom" required>
                </div>

                <div class="produk-input-group">
                    <label>Status Custom</label>
                    <select name="status_custom" id="edit_status_custom" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Deskripsi Referensi</label>
                    <textarea name="deskripsi_referensi" id="edit_deskripsi_referensi" required></textarea>
                </div>

                <div class="produk-input-group">
                    <label>Gambar Referensi Baru</label>
                    <input type="file" name="gambar_referensi" accept="image/*">
                    <small class="old-file-text" id="old_gambar_referensi"></small>
                </div>

                <div class="produk-input-group">
                    <label>Gambar Bahan Baru</label>
                    <input type="file" name="gambar_bahan" accept="image/*">
                    <small class="old-file-text" id="old_gambar_bahan"></small>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Update Kategori
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