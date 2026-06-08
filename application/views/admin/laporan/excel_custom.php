<?php

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Custom.xls");

$total = 0;

?>

<table border="1">

    <tr style="background:#f2f2f2;">
        <th>No</th>
        <th>Tanggal Pelunasan</th>
        <th>Kode Pesanan</th>
        <th>Customer</th>
        <th>Kategori Custom</th>
        <th>Estimasi Harga</th>
        <th>Uang Muka</th>
        <th>Pelunasan</th>
        <th>Metode Pembayaran</th>
    </tr>

    <?php
    $no = 1;

    foreach($laporan as $row):

        $total += $row->estimasi_harga;
    ?>

    <tr>
        <td><?= $no++; ?></td>

        <td>
            <?= date('d/m/Y', strtotime($row->tanggal_pembayaran)); ?>
        </td>

        <td>
            <?= $row->kode_pesanan; ?>
        </td>

        <td>
            <?= $row->nama_user; ?>
        </td>

        <td>
            <?= $row->kategori_custom; ?>
        </td>

        <td>
            Rp <?= number_format($row->estimasi_harga,0,',','.'); ?>
        </td>

        <td>
            Rp <?= number_format($row->uang_muka,0,',','.'); ?>
        </td>

        <td>
            Rp <?= number_format($row->jumlah_bayar,0,',','.'); ?>
        </td>

        <td>
            <?= ucfirst($row->metode_pembayaran); ?>
        </td>
    </tr>

    <?php endforeach; ?>

    <tr>
        <td colspan="5" align="right">
            <strong>Total Penjualan Custom</strong>
        </td>

        <td colspan="4">
            <strong>
                Rp <?= number_format($total,0,',','.'); ?>
            </strong>
        </td>
    </tr>

</table>