<!DOCTYPE html>
<html>
<head>
    <title>Nota Custom - <?= $nota->kode_pesanan; ?></title>
    <style>
        body{
            margin:0;
            padding:40px;
            background:#fff0f4;
            font-family:'Cormorant Garamond', serif;
            color:#4b2f28;
        }

        .nota-box{
            max-width:850px;
            margin:auto;
            background:white;
            border-radius:32px;
            padding:40px;
        }

        .nota-header{
            display:flex;
            align-items:center;
            gap:35px;
            border-bottom:1px dashed #efd5dc;
            padding-bottom:25px;
            margin-bottom:30px;
        }

        .nota-header img{
            width:140px;
        }

        .nota-title{
            flex:1;
            text-align:center;
        }

        .nota-title small{
            color:#e38ca5;
            font-weight:700;
        }

        .nota-title h1{
            margin:10px 0;
            font-size:52px;
            font-family:'Cormorant Garamond', serif;
        }

        .nota-section{
            margin-top:25px;
        }

        .nota-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:14px;
        }

        .nota-info{
            background:#fff7fa;
            border-radius:18px;
            padding:16px;
        }

        .nota-info small{
            display:block;
            color:#9b7c73;
            margin-bottom:6px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:14px;
        }

        th{
            background:#fff0f5;
            color:#9b536b;
            padding:14px;
            text-align:left;
        }

        td{
            padding:14px;
            border-bottom:1px solid #f4dbe2;
        }

        .nota-total{
            margin-top:25px;
            padding:20px;
            background:#fff0f5;
            border-radius:22px;
            text-align:right;
        }

        .nota-total h2{
            margin:8px 0 0;
            font-size:32px;
        }

        .print-area{
            text-align:center;
            margin-top:30px;
        }

        .print-area button{
            border:none;
            border-radius:999px;
            padding:14px 30px;
            background:linear-gradient(135deg,#ef9eb8,#c7826b);
            color:white;
            font-weight:700;
            cursor:pointer;
        }

        @media print{
            body{
                background:white;
                padding:0;
            }

            .nota-box{
                border-radius:0;
            }

            .print-area{
                display:none;
            }
        }
    </style>
</head>
<body>

<div class="nota-box">

    <div class="nota-header">
        <img src="<?= base_url('assets/img/logo-lavera.png'); ?>">

        <div class="nota-title">
            <small>Lavéra Custom Receipt</small>
            <h1>Nota Custom</h1>
            <span><?= $nota->kode_pesanan; ?></span>
        </div>
    </div>

    <div class="nota-section">
        <h3>Data Customer</h3>

        <div class="nota-grid">
            <div class="nota-info">
                <small>Nama Customer</small>
                <b><?= $nota->nama_user; ?></b>
            </div>

            <div class="nota-info">
                <small>No. Telepon</small>
                <b><?= $nota->no_telepon; ?></b>
            </div>

            <div class="nota-info">
                <small>Alamat</small>
                <b><?= $nota->alamat; ?></b>
            </div>

            <div class="nota-info">
                <small>Tanggal Pesanan</small>
                <b><?= date('d M Y H:i', strtotime($nota->tanggal_pesanan)); ?></b>
            </div>
        </div>
    </div>

    <div class="nota-section">
        <h3>Informasi Custom</h3>

        <div class="nota-grid">
            <div class="nota-info">
                <small>Kategori Custom</small>
                <b><?= $nota->kategori_custom; ?></b>
            </div>

            <div class="nota-info">
                <small>Status Pesanan</small>
                <b><?= ucwords(str_replace('_',' ', $nota->status_pesanan)); ?></b>
            </div>

            <div class="nota-info">
                <small>Detail Custom</small>
                <b><?= $nota->detail_custom; ?></b>
            </div>

            <div class="nota-info">
                <small>Diskon Custom</small>
                <b><?= $nota->diskon_custom; ?>%</b>
            </div>
        </div>
    </div>

    <div class="nota-section">
        <h3>Rincian Pembayaran</h3>

        <table>
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Kode</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Uang Muka</td>
                    <td><?= $nota->kode_dp ?? '-'; ?></td>
                    <td><?= ucfirst($nota->metode_dp ?? '-'); ?></td>
                    <td><?= ucwords(str_replace('_',' ', $nota->status_dp ?? '-')); ?></td>
                    <td>Rp <?= number_format($nota->jumlah_dp ?? 0,0,',','.'); ?></td>
                </tr>

                <tr>
                    <td>Pelunasan</td>
                    <td><?= $nota->kode_pelunasan ?? '-'; ?></td>
                    <td><?= ucfirst($nota->metode_pelunasan ?? '-'); ?></td>
                    <td><?= ucwords(str_replace('_',' ', $nota->status_pelunasan ?? '-')); ?></td>
                    <td>Rp <?= number_format($nota->jumlah_pelunasan ?? 0,0,',','.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="nota-total">
        <span>Total Estimasi Custom</span>
        <h2>Rp <?= number_format($nota->estimasi_harga,0,',','.'); ?></h2>
    </div>

    <div class="print-area">
        <button onclick="window.print()">Download / Cetak Nota</button>
    </div>

</div>

</body>
</html>