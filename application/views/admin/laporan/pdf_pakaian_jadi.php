<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan Pakaian Jadi</title>

<style>

body{
    font-family:Arial;
    padding:30px;
}

h2{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #000;
    padding:8px;
}

th{
    background:#eee;
}

</style>

</head>
<body onload="window.print()">

<h2>LAPORAN PENJUALAN PAKAIAN JADI</h2>

<p>
Periode :
<?= !empty($bulan) ? date('F', mktime(0,0,0,$bulan,1)) : 'Semua Bulan'; ?>
<?= $tahun; ?>
</p>

<table>

<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Kode Pesanan</th>
    <th>Customer</th>
    <th>Produk</th>
    <th>Qty</th>
    <th>Total</th>
</tr>
</thead>

<tbody>

<?php
$no=1;
$total=0;

foreach($laporan as $row):
$total += $row->jumlah_bayar;
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d/m/Y',strtotime($row->tanggal_pembayaran)); ?></td>
    <td><?= $row->kode_pesanan; ?></td>
    <td><?= $row->nama_user; ?></td>
    <td><?= $row->nama_pakaian; ?></td>
    <td><?= $row->jumlah; ?></td>
    <td>
        Rp <?= number_format($row->jumlah_bayar,0,',','.'); ?>
    </td>
</tr>

<?php endforeach; ?>

<tr>
    <td colspan="6">
        <b>Total Pendapatan</b>
    </td>

    <td>
        <b>
        Rp <?= number_format($total,0,',','.'); ?>
        </b>
    </td>
</tr>

</tbody>

</table>

</body>
</html>