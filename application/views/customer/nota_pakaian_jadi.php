<!DOCTYPE html>
<html>
<head>
    <title>Nota Pakaian Jadi - <?= $nota->kode_pesanan; ?></title>
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
            <small>Lavéra Fashion Receipt</small>
            <h1>Nota Pakaian Jadi</h1>
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
                <b><?= $nota->alamat_pengiriman ?: $nota->alamat; ?></b>
            </div>

            <div class="nota-info">
                <small>Tanggal Pesanan</small>
                <b><?= date('d M Y H:i', strtotime($nota->tanggal_pesanan)); ?></b>
            </div>
        </div>
    </div>

    <div class="nota-section">
        <h3>Rincian Produk</h3>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $nota->nama_pakaian; ?></td>
                    <td><?= $nota->ukuran; ?></td>
                    <td><?= $nota->jumlah; ?> pcs</td>
                    <td>Rp <?= number_format($nota->harga,0,',','.'); ?></td>
                    <td>Rp <?= number_format($nota->subtotal,0,',','.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="nota-section">
        <h3>Informasi Pembayaran & Pengiriman</h3>

        <div class="nota-grid">
            <div class="nota-info">
                <small>Metode Pembayaran</small>
                <b><?= ucfirst($nota->metode_pembayaran ?? '-'); ?></b>
            </div>

            <div class="nota-info">
                <small>Status Pembayaran</small>
                <b><?= ucwords(str_replace('_',' ', $nota->status_pembayaran ?? '-')); ?></b>
            </div>

            <div class="nota-info">
                <small>Ekspedisi</small>
                <b><?= $nota->ekspedisi ?: '-'; ?></b>
            </div>

            <div class="nota-info">
                <small>No Resi</small>
                <b><?= $nota->no_resi ?: '-'; ?></b>
            </div>
        </div>
    </div>

    <div class="nota-total">
        <span>Total Pembayaran</span>
        <h2>Rp <?= number_format($nota->total_bayar,0,',','.'); ?></h2>
    </div>

    <div class="print-area">
        <button onclick="window.print()">Download / Cetak Nota</button>
    </div>

</div>
</body>
</html>