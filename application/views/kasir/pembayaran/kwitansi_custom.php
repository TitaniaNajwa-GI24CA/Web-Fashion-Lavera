<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Custom - <?= $kwitansi->kode_pembayaran; ?></title>
    <style>
        body{
            font-family:'Cormorant Garamond', serif;
            background: #fff8fa;
            color: #4b2f28;
            padding: 40px;
        }

        .receipt-print{
            max-width: 760px;
            margin: auto;
            background: white;
            padding: 36px;
            border-radius: 22px;
            border: 1px solid #f2d5dc;
        }

        .receipt-head{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f6d6de;
            padding-bottom: 18px;
            margin-bottom: 24px;
        }

        .receipt-head h1{
            margin: 0;
            font-size: 28px;
        }

        .receipt-table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .receipt-table td{
            padding: 12px;
            border-bottom: 1px solid #f4dbe2;
        }

        .receipt-total{
            margin-top: 24px;
            padding: 18px;
            background: #fff0f5;
            border-radius: 18px;
            text-align: right;
        }

        .print-btn-area{
            margin-top: 24px;
            text-align: center;
        }

        .print-btn-area button{
            border: none;
            border-radius: 999px;
            padding: 14px 28px;
            background: linear-gradient(135deg, #ef9eb8, #c7826b);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        @media print{
            body{
                background: white;
                padding: 0;
            }

            .print-btn-area{
                display: none;
            }

            .receipt-print{
                border: none;
            }
        }

        .custom-receipt-header{
            display:flex;
            align-items:center;
            gap:40px;
            padding-bottom:25px;
            border-bottom:1px dashed #efd5dc;
            margin-bottom:35px;
        }

        .custom-receipt-logo img{
            width:140px;
        }

        .custom-receipt-title{
            flex:1;
            text-align:center;
        }

        .custom-receipt-title small{
            display:block;
            color:#e38ca5;
            font-weight:600;
            margin-bottom:10px;
            letter-spacing:.5px;
        }

        .custom-receipt-title h1{
            margin:0;
            font-size:30px;
            line-height:1;
            color:#4e2f28;
            font-family:''Cormorant Garamond', serif;
        }

        .custom-receipt-title span{
            display:block;
            margin-top:15px;
            font-size:14px;
            color:#7d6159;
        }

        .receipt-signature{
            margin-top:50px;
            display:flex;
            justify-content:flex-end;
        }

        .receipt-sign-box{
            text-align:center;
            min-width:220px;
        }

        .signature-space{
            height:80px;
        }

        .receipt-sign-box strong{
            display:block;
            font-size:16px;
            color:#4e2f28;
        }

        .receipt-sign-box span{
            font-size:13px;
            color:#9b7c73;
        }
    </style>
</head>
<body>

    <div class="receipt-print">
        <div class="custom-receipt-header">
            <div class="custom-receipt-logo">
                <img src="<?= base_url('assets/img/logo-lavera.png'); ?>">
            </div>
            <div class="custom-receipt-title">
            <small>Lavéra Custom Receipt</small>

            <h1>
                Kwitansi Pembayaran Custom
            </h1>

            <span>
                <?= $kwitansi->kode_pembayaran; ?>
            </span>
        </div>
    </div>

        <table class="receipt-table">
            <tr>
                <td>Nama Customer</td>
                <td><strong><?= $kwitansi->nama_user; ?></strong></td>
            </tr>

            <tr>
                <td>No Telepon</td>
                <td><?= $kwitansi->no_telepon; ?></td>
            </tr>

            <tr>
                <td>Kode Pesanan</td>
                <td><?= $kwitansi->kode_pesanan; ?></td>
            </tr>

            <tr>
                <td>Kategori Custom</td>
                <td><?= $kwitansi->kategori_custom; ?></td>
            </tr>

            <tr>
                <td>Estimasi Harga</td>
                <td>Rp <?= number_format($kwitansi->estimasi_harga,0,',','.'); ?></td>
            </tr>

            <tr>
                <td>Uang Muka</td>
                <td>Rp <?= number_format($kwitansi->uang_muka,0,',','.'); ?></td>
            </tr>

            <tr>
                <td>Metode Pembayaran</td>
                <td><?= ucfirst($kwitansi->metode_pembayaran); ?></td>
            </tr>

            <tr>
                <td>Status</td>
                <td><strong><?= ucwords($kwitansi->status_pembayaran); ?></strong></td>
            </tr>
        </table>

        <div class="receipt-total">
            <p>Jumlah Pelunasan</p>
            <h2>Rp <?= number_format($kwitansi->jumlah_bayar,0,',','.'); ?></h2>
        </div>
        
        <div class="receipt-signature">

        <div class="receipt-sign-box">
            <small>Diverifikasi Oleh</small>
            <div class="signature-space"></div>
                <strong>
                    <?= $nama_kasir ?? 'Kasir Lavéra'; ?>
                </strong>
                <span>Kasir Lavéra</span>
            </div>
        </div>

        <div class="print-btn-area">
            <button onclick="window.print()">Cetak Kwitansi</button>
        </div>
    </div>

</body>
</html>