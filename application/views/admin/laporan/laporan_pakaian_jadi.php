<div class="produk-card">

    <div class="produk-topbar">
        <form method="get" class="produk-topbar" style="width:100%;">
            <select name="bulan" class="filter-status">
                <option value="">Semua Bulan</option>
                <?php for($i=1; $i<=12; $i++): ?>
                    <option value="<?= $i; ?>" <?= ($bulan == $i) ? 'selected' : ''; ?>>
                        <?= date('F', mktime(0,0,0,$i,1)); ?>
                    </option>
                <?php endfor; ?>
            </select>

            <select name="tahun" class="filter-status">
                <option value="">Semua Tahun</option>
                <?php for($y=date('Y'); $y>=2024; $y--): ?>
                    <option value="<?= $y; ?>" <?= ($tahun == $y) ? 'selected' : ''; ?>>
                        <?= $y; ?>
                    </option>
                <?php endfor; ?>
            </select>

            <div class="laporan-action">
                <button type="submit" class="btn-pdf-report">
                    <i class="fa-solid fa-filter"></i>
                    Filter
                </button>

                <a href="<?= base_url(
                    'admin/laporan-pakaian-jadi-pdf?bulan='.$bulan.'&tahun='.$tahun
                ); ?>"
                class="btn-pdf-report">

                    <i class="fa-solid fa-file-pdf"></i>
                    PDF
                </a>

                <a href="<?= base_url(
                    'admin/laporan-pakaian-jadi-excel?bulan='.$bulan.'&tahun='.$tahun
                ); ?>"
                class="btn-excel-report">

                    <i class="fa-solid fa-file-excel"></i>
                    Excel
                </a>
            </div>
        </form>
    </div>

    <div class="dashboard-cards kasir-mini-cards">
        <div class="dashboard-card">
            <div class="card-icon pink">
                <i class="fa-solid fa-shirt"></i>
            </div>
            <div>
                <h5>Total Transaksi</h5>
                <h2><?= count($laporan); ?></h2>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon cream">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <h5>Total Pendapatan</h5>
                <h2>Rp <?= number_format($total_pendapatan,0,',','.'); ?></h2>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="produk-table lavera-datatable">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($laporan)): ?>
                    <?php foreach($laporan as $l): ?>
                        <tr>
                            <td><?= date('d M Y H:i', strtotime($l->tanggal_pembayaran)); ?></td>
                            <td>
                                <div class="produk-info">
                                    <h4><?= $l->kode_pembayaran; ?></h4>
                                    <small><?= $l->kode_pesanan; ?></small>
                                </div>
                            </td>
                            <td><?= $l->nama_user; ?></td>
                            <td>
                                <div class="produk-info">
                                    <h4><?= $l->nama_pakaian; ?></h4>
                                    <small>Ukuran <?= $l->ukuran; ?></small>
                                </div>
                            </td>
                            <td><?= $l->jumlah; ?> pcs</td>
                            <td><?= ucfirst($l->metode_pembayaran); ?></td>
                            <td>Rp <?= number_format($l->jumlah_bayar,0,',','.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-data">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>Belum ada data laporan pakaian jadi.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>