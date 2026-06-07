<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Pakaian Jadi - <?= $kwitansi->kode_pembayaran; ?></title>

    <style>
        body{
            margin:0;
            padding:40px;
            background:#fff0f4;
            font-family: 'Cormorant Garamond', serif;
            color:#4b2f28;
        }

        .receipt-box{
            max-width:850px;
            margin:auto;
            background:rgba(255,255,255,.96);
            border-radius:32px;
            padding:40px;
        }

        .receipt-header{
            display:flex;
            align-items:center;
            gap:40px;
            border-bottom:1px dashed #efd5dc;
            padding-bottom:26px;
            margin-bottom:30px;
        }

        .receipt-header img{
            width:145px;
        }

        .receipt-title{
            flex:1;
            text-align:center;
        }

        .receipt-title small{
            color:#e38ca5;
            font-weight:700;
        }

        .receipt-title h1{
            margin:10px 0;
            font-size:42px;
            line-height:1;
            font-family: 'Cormorant Garamond', serif;
            color:#4b2f28;
        }

        .receipt-title span{
            color:#7d6159;
            font-size:18px;
        }

        .receipt-section{
            margin-top:25px;
        }

        .receipt-section h3{
            margin-bottom:14px;
            color:#4b2f28;
        }

        .receipt-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:14px;
        }

        .receipt-info{
            background:#fff7fa;
            border-radius:18px;
            padding:16px;
        }

        .receipt-info small{
            display:block;
            color:#9b7c73;
            margin-bottom:6px;
        }

        .receipt-info b{
            color:#4b2f28;
        }

        .receipt-table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:18px;
            margin-top:12px;
        }

        .receipt-table th{
            background:#fff0f5;
            color:#9b536b;
            padding:14px;
            text-align:left;
        }

        .receipt-table td{
            padding:14px;
            border-bottom:1px solid #f4dbe2;
        }

        .receipt-total{
            margin-top:24px;
            background:linear-gradient(135deg,#fff0f5,#fff7fa);
            border-radius:22px;
            padding:20px;
            text-align:right;
        }

        .receipt-total span{
            color:#9b7c73;
        }

        .receipt-total h2{
            margin:8px 0 0;
            font-size:32px;
            color:#4b2f28;
        }

        .receipt-signature{
            margin-top:50px;
            display:flex;
            justify-content:flex-end;
        }

        .receipt-sign-box{
            min-width:220px;
            text-align:center;
        }

        .signature-space{
            height:80px;
        }

        .receipt-sign-box small{
            color:#9b7c73;
        }

        .receipt-sign-box strong{
            display:block;
            color:#4b2f28;
        }

        .receipt-sign-box span{
            font-size:13px;
            color:#9b7c73;
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

            .receipt-box{
                box-shadow:none;
                border-radius:0;
            }

            .print-area{
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="receipt-box">

    <div class="receipt-header">
        <img src="<?= base_url('assets/img/logo-lavera.png'); ?>">

        <div class="receipt-title">
            <small>Lavéra Fashion Receipt</small>
            <h1>Kwitansi Pakaian Jadi</h1>
            <span><?= $kwitansi->kode_pembayaran; ?></span>
        </div>
    </div>

    <div class="receipt-section">
        <h3>Data Customer</h3>

        <div class="receipt-grid">
            <div class="receipt-info">
                <small>Nama Customer</small>
                <b><?= $kwitansi->nama_user; ?></b>
            </div>

            <div class="receipt-info">
                <small>No. Telepon</small>
                <b><?= $kwitansi->no_telepon; ?></b>
            </div>

            <div class="receipt-info">
                <small>Kode Pesanan</small>
                <b><?= $kwitansi->kode_pesanan; ?></b>
            </div>

            <div class="receipt-info">
                <small>Tanggal Pembayaran</small>
                <b><?= date('d M Y H:i', strtotime($kwitansi->tanggal_pembayaran)); ?></b>
            </div>
        </div>
    </div>

    <div class="receipt-section">
        <h3>Rincian Produk</h3>

        <table class="receipt-table">
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
                    <td><?= $kwitansi->nama_pakaian; ?></td>
                    <td><?= $kwitansi->ukuran; ?></td>
                    <td><?= $kwitansi->jumlah; ?> pcs</td>
                    <td>Rp <?= number_format($kwitansi->harga,0,',','.'); ?></td>
                    <td>Rp <?= number_format($kwitansi->subtotal,0,',','.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="receipt-section">
        <h3>Informasi Pembayaran</h3>

        <div class="receipt-grid">
            <div class="receipt-info">
                <small>Metode Pembayaran</small>
                <b><?= ucfirst($kwitansi->metode_pembayaran); ?></b>
            </div>

            <div class="receipt-info">
                <small>Status</small>
                <b><?= ucwords(str_replace('_',' ', $kwitansi->status_pembayaran)); ?></b>
            </div>
        </div>
    </div>

    <div class="receipt-total">
        <span>Total Pembayaran</span>
        <h2>Rp <?= number_format($kwitansi->jumlah_bayar,0,',','.'); ?></h2>
    </div>

    <div class="receipt-signature">
        <div class="receipt-sign-box">
            <small>Diverifikasi Oleh</small>
            <div class="signature-space"></div>
            <strong><?= $nama_kasir ?? 'Kasir Lavéra'; ?></strong>
            <span>Kasir Lavéra</span>
        </div>
    </div>

    <div class="print-area">
        <button onclick="window.print()">
            Cetak Kwitansi
        </button>
    </div>

</div>

</body>
</html>