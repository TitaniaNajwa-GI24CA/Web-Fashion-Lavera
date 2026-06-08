<?php

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pakaian_Jadi.xls");

?>

<table border="1">

<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Kode Pesanan</th>
    <th>Customer</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Total</th>
</tr>

<?php
$no=1;
foreach($laporan as $row):
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row->tanggal_pembayaran; ?></td>
    <td><?= $row->kode_pesanan; ?></td>
    <td><?= $row->nama_user; ?></td>
    <td><?= $row->nama_pakaian; ?></td>
    <td><?= $row->jumlah; ?></td>
    <td><?= $row->jumlah_bayar; ?></td>
</tr>

<?php endforeach; ?>

</table>