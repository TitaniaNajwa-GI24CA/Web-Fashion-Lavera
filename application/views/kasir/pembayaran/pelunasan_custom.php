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
            <input type="text" placeholder="Cari pelunasan custom...">
        </div>

        <select class="filter-status">
            <option value="">Semua Status</option>
            <option value="belum_bayar">Belum Bayar</option>
            <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
            <option value="menunggu_pembayaran_cash">Menunggu Cash</option>
            <option value="berhasil">Berhasil</option>
            <option value="ditolak">Ditolak</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Desain</th>
                    <th>Pembayaran</th>
                    <th>Customer</th>
                    <th>Kategori</th>
                    <th>Metode</th>
                    <th>Pelunasan</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($pembayaran)): ?>
                    <?php foreach($pembayaran as $p): ?>
                        <tr>
                            <td>
                                <?php if(!empty($p->gambar_desain)): ?>
                                    <a href="<?= base_url('assets/img/request_custom/'.$p->gambar_desain); ?>" target="_blank">
                                        <img src="<?= base_url('assets/img/request_custom/'.$p->gambar_desain); ?>" class="produk-img">
                                    </a>
                                <?php else: ?>
                                    <div class="payment-proof-empty">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->kode_pembayaran; ?></h4>
                                    <span><?= $p->kode_pesanan; ?></span>
                                    <small>
                                        <?= !empty($p->tanggal_pembayaran)
                                            ? date('d M Y H:i', strtotime($p->tanggal_pembayaran))
                                            : 'Belum dibayar'; ?>
                                    </small>
                                </div>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->nama_user; ?></h4>
                                    <small><?= $p->no_telepon; ?></small>
                                </div>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->kategori_custom; ?></h4>
                                    <small><?= strlen($p->detail_custom) > 45 ? substr($p->detail_custom,0,45).'...' : $p->detail_custom; ?></small>
                                </div>
                            </td>

                            <td>
                                <?= !empty($p->metode_pembayaran) ? ucfirst($p->metode_pembayaran) : '-'; ?>
                            </td>

                            <td>
                                Rp <?= number_format($p->jumlah_bayar,0,',','.'); ?>
                            </td>

                            <td>
                                <?php if(!empty($p->bukti_pembayaran)): ?>
                                    <a href="<?= base_url('assets/img/pembayaran/'.$p->bukti_pembayaran); ?>" target="_blank">
                                        <img src="<?= base_url('assets/img/pembayaran/'.$p->bukti_pembayaran); ?>" class="payment-proof-img">
                                    </a>
                                <?php elseif($p->metode_pembayaran == 'cash'): ?>
                                    <div class="payment-proof-empty">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="payment-proof-empty">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <span class="payment-status <?= strtolower($p->status_pembayaran); ?>">
                                    <?= ucwords(str_replace('_',' ', $p->status_pembayaran)); ?>
                                </span>
                            </td>

                            <td>
                                <div class="produk-action">

                                    <a href="#"
                                       class="edit-btn open-pelunasan-status-modal"
                                       data-id="<?= $p->id_pembayaran; ?>"
                                       data-kode="<?= $p->kode_pembayaran; ?>"
                                       data-status="<?= $p->status_pembayaran; ?>"
                                       data-metode="<?= $p->metode_pembayaran; ?>"
                                       data-jumlah="<?= $p->jumlah_bayar; ?>">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <?php if($p->status_pembayaran == 'berhasil'): ?>
                                        <a href="<?= base_url('kasir/cetak-kwitansi-custom/'.$p->id_pembayaran); ?>"
                                           target="_blank"
                                           class="print-btn">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">
                            <div class="admin-empty-data">
                                <i class="fa-solid fa-wallet"></i>
                                <p>Belum ada data pelunasan custom.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="produk-modal" id="pelunasanStatusModal">
    <div class="produk-modal-box">

        <button class="close-produk-modal" id="closePelunasanStatusModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Edit Status Pelunasan</h2>
            <p>Verifikasi pembayaran pelunasan custom customer.</p>
        </div>

        <form action="<?= base_url('kasir/update-status-pelunasan-custom'); ?>" method="post">

            <input type="hidden" name="id_pembayaran" id="edit_id_pelunasan">

            <div class="produk-modal-grid">

                <div class="produk-input-group produk-full">
                    <label>Kode Pembayaran</label>
                    <input type="text" id="edit_kode_pelunasan" readonly>
                </div>

                <div class="produk-input-group">
                    <label>Metode Pembayaran</label>
                    <input type="text" id="edit_metode_pelunasan" readonly>
                </div>

                <div class="produk-input-group">
                    <label>Jumlah Pelunasan</label>
                    <input type="text" id="edit_jumlah_pelunasan" readonly>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" id="edit_status_pelunasan" required>
                        <option value="belum_bayar">Belum Bayar</option>
                        <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                        <option value="menunggu_pembayaran_cash">Menunggu Pembayaran Cash</option>
                        <option value="berhasil">Berhasil</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="produk-submit-btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Update Status
            </button>

        </form>
    </div>
</div>