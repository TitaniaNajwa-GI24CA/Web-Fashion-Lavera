<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Custom</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            padding: 35px;
            color: #222;
        }

        .report-header{
            text-align: center;
            margin-bottom: 25px;
        }

        .report-header h2{
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }

        .report-header p{
            margin: 6px 0 0;
            font-size: 13px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td{
            border: 1px solid #333;
            padding: 8px;
        }

        th{
            background: #f2f2f2;
            text-align: center;
        }

        .text-right{
            text-align: right;
        }

        .text-center{
            text-align: center;
        }

        .total-row td{
            font-weight: bold;
            background: #f7f7f7;
        }

        .print-btn{
            margin-top: 25px;
            text-align: center;
        }

        .print-btn button{
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: #db5f6f;
            color: white;
            cursor: pointer;
        }

        @media print{
            .print-btn{
                display: none;
            }

            body{
                padding: 10px;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="report-header">
        <h2>Laporan Penjualan Custom</h2>

        <p>
            Periode:
            <?= !empty($bulan) ? date('F', mktime(0,0,0,$bulan,1)) : 'Semua Bulan'; ?>
            <?= !empty($tahun) ? $tahun : 'Semua Tahun'; ?>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pelunasan</th>
                <th>Kode Pesanan</th>
                <th>Customer</th>
                <th>Kategori Custom</th>
                <th>Estimasi</th>
                <th>DP</th>
                <th>Pelunasan</th>
                <th>Metode</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            $total_estimasi = 0;
            $total_dp = 0;
            $total_pelunasan = 0;
            ?>

            <?php if(!empty($laporan)): ?>
                <?php foreach($laporan as $row): ?>
                    <?php
                    $total_estimasi += $row->estimasi_harga;
                    $total_dp += $row->uang_muka;
                    $total_pelunasan += $row->jumlah_bayar;
                    ?>

                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= date('d/m/Y', strtotime($row->tanggal_pembayaran)); ?></td>
                        <td><?= $row->kode_pesanan; ?></td>
                        <td><?= $row->nama_user; ?></td>
                        <td><?= $row->kategori_custom; ?></td>
                        <td class="text-right">Rp <?= number_format($row->estimasi_harga,0,',','.'); ?></td>
                        <td class="text-right">Rp <?= number_format($row->uang_muka,0,',','.'); ?></td>
                        <td class="text-right">Rp <?= number_format($row->jumlah_bayar,0,',','.'); ?></td>
                        <td><?= ucfirst($row->metode_pembayaran); ?></td>
                    </tr>
                <?php endforeach; ?>

                <tr class="total-row">
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-right">Rp <?= number_format($total_estimasi,0,',','.'); ?></td>
                    <td class="text-right">Rp <?= number_format($total_dp,0,',','.'); ?></td>
                    <td class="text-right">Rp <?= number_format($total_pelunasan,0,',','.'); ?></td>
                    <td></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data laporan custom.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="print-btn">
        <button onclick="window.print()">Cetak / Save PDF</button>
    </div>

</body>
</html>