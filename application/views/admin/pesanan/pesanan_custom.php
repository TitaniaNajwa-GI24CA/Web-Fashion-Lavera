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
            <input type="text" id="searchPesanan" placeholder="Cari kode pesanan, customer, kategori custom...">
        </div>

        <select id="filterBulan" class="filter-status">
            <option value="">Semua Bulan</option>
            <?php for($i=1;$i<=12;$i++): ?>
                <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,1)); ?></option>
            <?php endfor; ?>
        </select>

        <select id="filterStatusPesanan" class="filter-status">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="diproses">Diproses</option>
            <option value="diproduksi">Diproduksi</option>
            <option value="siap_diambil">Siap Diambil</option>
            <option value="dikirim">Dikirim</option>
            <option value="selesai">Selesai</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Desain</th>
                    <th>Pesanan</th>
                    <th>Waktu Pesanan</th>
                    <th>Customer</th>
                    <th>Kategori</th>
                    <th>Total</th>
                    <th>DP</th>
                    <th>Status Bayar</th>
                    <th>Status Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($pesanan)): ?>
                    <?php foreach($pesanan as $p): ?>
                        <tr class="pesanan-row"
                            data-status="<?= strtolower($p->status_pesanan); ?>"
                            data-bulan="<?= date('n', strtotime($p->tanggal_pesanan)); ?>">

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
                                    <h4><?= $p->kode_pesanan; ?></h4>
                                    <span><?= $p->kategori_custom; ?></span>
                                    <small><?= $p->jenis_pembayaran ? ucwords(str_replace('_',' ', $p->jenis_pembayaran)) : 'Belum ada pembayaran'; ?></small>
                                </div>
                            </td>

                            <td>
                                <div class="order-date">
                                    <strong><?= date('d M Y', strtotime($p->tanggal_pesanan)); ?></strong>
                                    <small><?= date('H:i', strtotime($p->tanggal_pesanan)); ?> WIB</small>
                                </div>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->nama_user; ?></h4>
                                    <small><?= $p->no_telepon; ?></small>
                                </div>
                            </td>

                            <td><?= $p->kategori_custom; ?></td>

                            <td>
                                Rp <?= number_format($p->total_bayar,0,',','.'); ?>
                            </td>

                            <td>
                                Rp <?= number_format($p->uang_muka,0,',','.'); ?>
                            </td>

                            <td>
                                <?php
                                    $status_bayar = !empty($p->status_pembayaran)
                                        ? $p->status_pembayaran
                                        : 'belum_bayar';
                                ?>

                                <span class="payment-status <?= strtolower($status_bayar); ?>">
                                    <?= ucwords(str_replace('_',' ', $status_bayar)); ?>
                                </span>
                            </td>

                            <td>
                                <span class="order-status <?= strtolower($p->status_pesanan); ?>">
                                    <?= ucwords(str_replace('_',' ', $p->status_pesanan)); ?>
                                </span>
                            </td>

                            <td>
                                <div class="produk-action">
                                    <a href="<?= base_url('admin/detail-pesanan-custom/'.$p->id_pesanan); ?>" class="view-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="#"
                                       class="edit-btn open-status-custom-modal"
                                       data-id="<?= $p->id_pesanan; ?>"
                                       data-kode="<?= $p->kode_pesanan; ?>"
                                       data-status="<?= $p->status_pesanan; ?>">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="admin-empty-data">
                                <i class="fa-solid fa-scissors"></i>
                                <p>Belum ada pesanan custom.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<div class="produk-modal" id="statusPesananCustomModal">
    <div class="produk-modal-box">
        <button class="close-produk-modal" id="closeStatusPesananCustomModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Edit Status Pesanan Custom</h2>
            <p>Perbarui status pesanan custom customer.</p>
        </div>

        <form action="<?= base_url('admin/update-status-pesanan-custom'); ?>" method="post">
            <input type="hidden" name="id_pesanan" id="edit_id_pesanan_custom">

            <div class="produk-modal-grid">
                <div class="produk-input-group produk-full">
                    <label>Kode Pesanan</label>
                    <input type="text" id="edit_kode_pesanan_custom" readonly>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Status Pesanan</label>
                    <select name="status_pesanan" id="edit_status_pesanan_custom" required>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="diproduksi">Diproduksi</option>
                        <option value="siap_diambil">Siap Diambil</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
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