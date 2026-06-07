

<?php if($this->session->flashdata('success')): ?>
<div class="lavera-alert-modal" id="laveraAlertModal">
    <div class="success-box">
        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>
        <h3>Berhasil!</h3>
        <p><?= $this->session->flashdata('success'); ?></p>
    </div>
</div>
<?php endif; ?>

<div class="produk-card">

    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchCustomRequest" placeholder="Cari customer, kategori, detail...">
        </div>

        <select id="filterStatusRequest" class="filter-status">
            <option value="">Semua Status</option>
            <option value="Pending">Pending</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
            <option value="Menunggu">Menunggu</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Desain</th>
                    <th>Request</th>
                    <th>Customer</th>
                    <th>Riwayat</th>
                    <th>Estimasi</th>
                    <th>DP</th>
                    <th>Diskon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($request_custom)): ?>
                    <?php foreach($request_custom as $r): ?>
                        <tr class="request-row" data-status="<?= $r->status_request; ?>">

                            <td>
                                <?php if(!empty($r->gambar_desain)): ?>
                                    <a href="<?= base_url('assets/img/request_custom/'.$r->gambar_desain); ?>" target="_blank">
                                        <img src="<?= base_url('assets/img/request_custom/'.$r->gambar_desain); ?>" class="produk-img">
                                    </a>
                                <?php else: ?>
                                    <img src="<?= base_url('assets/img/custom/'.$r->gambar_referensi); ?>" class="produk-img">
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $r->kategori_custom; ?></h4>
                                    <span><?= date('d M Y', strtotime($r->tanggal_request)); ?></span>
                                   <small>
                                        <?= strlen($r->detail_custom) > 70
                                            ? substr($r->detail_custom, 0, 70).'...'
                                            : $r->detail_custom; ?>
                                    </small>
                                </div>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $r->nama_user; ?></h4>
                                    <small><?= $r->no_telepon; ?></small>
                                </div>
                            </td>

                            <td>
                                <span class="request-history-badge">
                                    <?= $r->total_request_customer; ?>x request
                                </span>
                            </td>

                            <td>
                                Rp <?= number_format($r->estimasi_harga,0,',','.'); ?>
                            </td>

                            <td>
                                Rp <?= number_format($r->uang_muka,0,',','.'); ?>
                            </td>

                            <td>
                                <?= $r->diskon_custom; ?>%
                            </td>

                            <td>
                                <span class="order-status <?= strtolower($r->status_request); ?>">
                                    <?= $r->status_request; ?>
                                </span>
                            </td>

                            <td>
                                <div class="produk-action">
                                    <a href="#"
                                       class="edit-btn open-edit-request-modal"
                                       data-id="<?= $r->id_request; ?>"
                                       data-kode="REQ-<?= $r->id_request; ?>"
                                       data-kategori="<?= htmlspecialchars($r->kategori_custom, ENT_QUOTES); ?>"
                                       data-customer="<?= htmlspecialchars($r->nama_user, ENT_QUOTES); ?>"
                                       data-estimasi="<?= $r->estimasi_harga; ?>"
                                       data-diskon="<?= $r->diskon_custom; ?>"
                                       data-uangmuka="<?= $r->uang_muka; ?>"
                                       data-status="<?= $r->status_request; ?>"
                                       data-totalrequest="<?= $r->total_request_customer; ?>">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">
                            <div class="admin-empty-data">
                                <i class="fa-solid fa-scissors"></i>
                                <p>Belum ada request custom.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<div class="produk-modal" id="editRequestModal">
    <div class="produk-modal-box">

        <button class="close-produk-modal" id="closeEditRequestModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Konfirmasi Request Custom</h2>
            <p>Isi estimasi biaya, DP, diskon, dan status request customer.</p>
        </div>

        <form action="<?= base_url('admin/update-request-custom'); ?>" method="post">

            <input type="hidden" name="id_request" id="edit_id_request">

            <div class="produk-modal-grid">

                <div class="produk-input-group">
                    <label>Kode Request</label>
                    <input type="text" id="edit_kode_request" readonly>
                </div>

                <div class="produk-input-group">
                    <label>Customer</label>
                    <input type="text" id="edit_customer_request" readonly>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Kategori Custom</label>
                    <input type="text" id="edit_kategori_request" readonly>
                </div>

                <div class="produk-input-group">
                    <label>Estimasi Biaya</label>
                    <input type="number" name="estimasi_harga" id="edit_estimasi_harga" required>
                </div>

                <div class="produk-input-group">
                    <label>Uang Muka (50%)</label>
                    <input
                        type="number"
                        name="uang_muka"
                        id="edit_uang_muka"
                        readonly>
                    <small class="request-discount-info">
                        Uang muka otomatis dihitung 50% dari estimasi biaya.
                    </small>
                </div>

                <div class="produk-input-group">
                    <label>Diskon Custom (%)</label>
                    <input type="number" name="diskon_custom" id="edit_diskon_custom" value="0" min="0">
                    <small id="discountInfoText" class="request-discount-info"></small>
                </div>

                <div class="produk-input-group">
                    <label>Status Konfirmasi</label>
                    <select name="status_request" id="edit_status_request" required>
                        <option value="Pending">Pending</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Menunggu">Menunggu</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Konfirmasi
            </button>

        </form>

    </div>
</div>