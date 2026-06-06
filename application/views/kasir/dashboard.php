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

<div class="dashboard-cards">
    
    <div class="dashboard-card">
        <div class="card-icon peach">
            <i class="fa-solid fa-clock"></i>
        </div>

        <div>
            <h5>Menunggu Verifikasi</h5>
            <h2><?= $menunggu_verifikasi; ?></h2>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-icon cream">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div>
            <h5>Pembayaran Berhasil</h5>
            <h2><?= $pembayaran_berhasil; ?></h2>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-icon pink">
            <i class="fa-solid fa-wallet"></i>
        </div>

        <div>
            <h5>Pendapatan</h5>
            <h2>Rp <?= number_format($pendapatan,0,',','.'); ?></h2>
        </div>
    </div>

</div>

<div class="dashboard-grid">

    <?php
        $labels = [];
        $values = [];

        foreach($grafik_pembayaran as $g){
            $labels[] = date('d M', strtotime($g->tanggal));
            $values[] = (int) $g->total;
        }
    ?>

    <div class="dashboard-chart-card">
        <div class="table-header">
            <div>
                <h3>Grafik Pembayaran</h3>
                <p>Ringkasan pembayaran berhasil Lavéra</p>
            </div>
        </div>

        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const salesLabels = <?= json_encode($labels); ?>;
        const salesValues = <?= json_encode($values); ?>;
    </script>

    <div class="dashboard-notification">

        <div class="table-header">
            <h3>Notifikasi Kasir</h3>
        </div>

        <?php if(!empty($notifikasi)): ?>
            <?php foreach($notifikasi as $n): ?>

                <div class="notif-item">
                    <div class="notif-icon">
                        <i class="fa-regular fa-bell"></i>
                    </div>

                    <div>
                        <h4><?= $n->judul_notifikasi; ?></h4>
                        <p><?= $n->pesan_notifikasi; ?></p>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>

            <div class="notif-item">
                <div class="notif-icon">
                    <i class="fa-regular fa-bell-slash"></i>
                </div>

                <div>
                    <h4>Tidak ada notifikasi</h4>
                    <p>Belum ada pembayaran baru yang perlu diverifikasi.</p>
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>