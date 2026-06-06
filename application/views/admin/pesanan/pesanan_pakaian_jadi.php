<div class="produk-card">
    <div class="produk-topbar">
        <div class="search-product">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
                type="text"
                id="searchPesanan"
                placeholder="Cari kode pesanan, customer, produk...">
        </div>

        <select id="filterBulan" class="filter-status">
            <option value="">Semua Bulan</option>

            <?php
            for($i=1;$i<=12;$i++):
            ?>
                <option value="<?= $i ?>">
                    <?= date('F', mktime(0,0,0,$i,1)); ?>
                </option>
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
                    <th>Foto</th>
                    <th>Pesanan</th>
                    <th>Waktu Pesanan</th>
                    <th>Customer</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($pesanan)): ?>
                    <?php foreach($pesanan as $p): ?>
                        <tr class="pesanan-row" data-status="<?= strtolower($p->status_pesanan); ?>" data-bulan="<?= date('n', strtotime($p->tanggal_pesanan)); ?>">
                            <td>
                                <img src="<?= base_url('assets/img/produk/' . $p->foto_4); ?>" class="produk-img">
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->kode_pesanan; ?></h4>
                                    <span><?= $p->nama_pakaian; ?></span>
                                    <small>Ukuran: <?= $p->ukuran; ?></small>
                                </div>
                            </td>

                            <td>
                                <div class="order-date">
                                    <strong>
                                        <?= date('d M Y', strtotime($p->tanggal_pesanan)); ?>
                                    </strong>

                                    <small>
                                        <?= date('H:i', strtotime($p->tanggal_pesanan)); ?> WIB
                                    </small>
                                </div>
                            </td>

                            <td>
                                <div class="produk-info">
                                    <h4><?= $p->nama_user; ?></h4>
                                    <small><?= $p->no_telepon; ?></small>
                                </div>
                            </td>

                            <td><?= $p->jumlah; ?> pcs</td>

                            <td>
                                Rp <?= number_format($p->total_bayar,0,',','.'); ?>
                            </td>

                            <td>
                                <?= ucfirst($p->metode_pembayaran ?? '-'); ?>
                            </td>

                            <td>
                                <?php
                                    $status_bayar = !empty($p->status_pembayaran)
                                        ? $p->status_pembayaran
                                        : 'belum_bayar';
                                ?>

                                <span class="payment-status <?= strtolower($status_bayar); ?>">
                                    <?= ucwords(str_replace('_', ' ', $status_bayar)); ?>
                                </span>
                            </td>

                            <td>
                                <span class="order-status <?= strtolower($p->status_pesanan); ?>">
                                    <?= ucwords(str_replace('_',' ', $p->status_pesanan)); ?>
                                </span>
                            </td>

                            <td>
                                <div class="produk-action">
                                    <a href="<?= base_url('admin/detail-pesanan/'.$p->id_pesanan); ?>" class="view-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="#"
                                        class="edit-btn open-status-modal"
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
                        <td colspan="8">
                            <div class="admin-empty-data">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <p>Belum ada pesanan pakaian jadi.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<div class="produk-modal" id="statusPesananModal">
    <div class="produk-modal-box">
        <button class="close-produk-modal" id="closeStatusPesananModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="produk-modal-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="produk-modal-logo">
            <h2>Edit Status Pesanan</h2>
            <p>Perbarui status pesanan pakaian jadi customer.</p>
        </div>

        <form action="<?= base_url('admin/update-status-pesanan-pakaian-jadi'); ?>" method="post">

            <input type="hidden" name="id_pesanan" id="edit_id_pesanan">

            <div class="produk-modal-grid">

                <div class="produk-input-group produk-full">
                    <label>Kode Pesanan</label>
                    <input type="text" id="edit_kode_pesanan" readonly>
                </div>

                <div class="produk-input-group produk-full">
                    <label>Status Pesanan</label>
                    <select name="status_pesanan" id="edit_status_pesanan" required>
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