-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 07:10 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lavera`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom`
--

CREATE TABLE `tbl_custom` (
  `id_custom` int(11) NOT NULL,
  `kategori_custom` varchar(100) NOT NULL,
  `deskripsi_referensi` text NOT NULL,
  `gambar_referensi` varchar(255) NOT NULL,
  `gambar_bahan` varchar(255) NOT NULL,
  `status_custom` enum('aktif','nonaktif','','') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alamat` text,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pesanan`
--

CREATE TABLE `tbl_detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_pakaian_jadi` int(11) DEFAULT NULL,
  `id_request` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT '1',
  `harga` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gambar_request`
--

CREATE TABLE `tbl_gambar_request` (
  `id_gambar_request` int(11) NOT NULL,
  `id_request` int(11) NOT NULL,
  `gambar_desain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasir`
--

CREATE TABLE `tbl_kasir` (
  `id_kasir` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_pakaian_jadi` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `judul_notifikasi` varchar(100) NOT NULL,
  `pesan_notifikasi` text NOT NULL,
  `status_baca` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pakaian_jadi`
--

CREATE TABLE `tbl_pakaian_jadi` (
  `id_pakaian_jadi` int(11) NOT NULL,
  `nama_pakaian` varchar(100) NOT NULL,
  `detail_model` text NOT NULL,
  `detail_bahan` text NOT NULL,
  `ukuran` enum('S','M','L','XL') NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `diskon_produk` int(11) NOT NULL DEFAULT '0',
  `foto_1` varchar(255) NOT NULL,
  `foto_2` varchar(255) NOT NULL,
  `foto_3` varchar(255) NOT NULL,
  `foto_4` varchar(255) NOT NULL,
  `status_produk` enum('Aktif','Nonaktif','','') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `id_request` int(11) DEFAULT NULL,
  `kode_pembayaran` varchar(30) NOT NULL,
  `jenis_pembayaran` enum('dp','full_payment') NOT NULL,
  `metode_pembayaran` enum('cash','transfer') NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('menunggu_verifikasi','berhasil','ditolak') DEFAULT 'menunggu_verifikasi',
  `tanggal_pembayaran` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_request` int(11) DEFAULT NULL,
  `kode_pesanan` varchar(30) NOT NULL,
  `total_bayar` decimal(12,2) NOT NULL,
  `tipe_pesanan` enum('pakaian_jadi','custom') NOT NULL,
  `status_pesanan` enum('pending','diproses','diproduksi','siap_diambil','dikirim','selesai','dibatalkan') DEFAULT 'pending',
  `metode_pengambilan` enum('pickup','delivery') DEFAULT 'delivery',
  `alamat_pengiriman` text,
  `tanggal_pesanan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_custom`
--

CREATE TABLE `tbl_request_custom` (
  `id_request` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_custom` int(11) NOT NULL,
  `detail_custom` text NOT NULL,
  `estimasi_harga` decimal(12,2) NOT NULL,
  `diskon_custom` int(11) NOT NULL DEFAULT '0',
  `uang_muka` decimal(12,2) NOT NULL,
  `status_request` enum('Pending','Disetujui','Ditolak','Menunggu Uang Muka','Uang Muka Terverifikasi') NOT NULL DEFAULT 'Pending',
  `tanggal_request` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer','kasir') NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_custom`
--
ALTER TABLE `tbl_custom`
  ADD PRIMARY KEY (`id_custom`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_pakaian_jadi` (`id_pakaian_jadi`),
  ADD KEY `id_request` (`id_request`);

--
-- Indexes for table `tbl_gambar_request`
--
ALTER TABLE `tbl_gambar_request`
  ADD PRIMARY KEY (`id_gambar_request`),
  ADD KEY `id_request` (`id_request`);

--
-- Indexes for table `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  ADD PRIMARY KEY (`id_kasir`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_pakaian_jadi` (`id_pakaian_jadi`);

--
-- Indexes for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tbl_pakaian_jadi`
--
ALTER TABLE `tbl_pakaian_jadi`
  ADD PRIMARY KEY (`id_pakaian_jadi`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_request` (`id_request`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_request` (`id_request`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `tbl_request_custom`
--
ALTER TABLE `tbl_request_custom`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_custom` (`id_custom`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_custom`
--
ALTER TABLE `tbl_custom`
  MODIFY `id_custom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_gambar_request`
--
ALTER TABLE `tbl_gambar_request`
  MODIFY `id_gambar_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pakaian_jadi`
--
ALTER TABLE `tbl_pakaian_jadi`
  MODIFY `id_pakaian_jadi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_request_custom`
--
ALTER TABLE `tbl_request_custom`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `tbl_customer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD CONSTRAINT `tbl_detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_pesanan_ibfk_2` FOREIGN KEY (`id_pakaian_jadi`) REFERENCES `tbl_pakaian_jadi` (`id_pakaian_jadi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_pesanan_ibfk_3` FOREIGN KEY (`id_request`) REFERENCES `tbl_request_custom` (`id_request`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_gambar_request`
--
ALTER TABLE `tbl_gambar_request`
  ADD CONSTRAINT `tbl_gambar_request_ibfk_1` FOREIGN KEY (`id_request`) REFERENCES `tbl_request_custom` (`id_request`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  ADD CONSTRAINT `tbl_kasir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `tbl_keranjang_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_keranjang_ibfk_2` FOREIGN KEY (`id_pakaian_jadi`) REFERENCES `tbl_pakaian_jadi` (`id_pakaian_jadi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD CONSTRAINT `tbl_notifikasi_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_notifikasi_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pembayaran_ibfk_2` FOREIGN KEY (`id_request`) REFERENCES `tbl_request_custom` (`id_request`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`id_request`) REFERENCES `tbl_request_custom` (`id_request`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id_customer`);

--
-- Constraints for table `tbl_request_custom`
--
ALTER TABLE `tbl_request_custom`
  ADD CONSTRAINT `tbl_request_custom_ibfk_1` FOREIGN KEY (`id_custom`) REFERENCES `tbl_custom` (`id_custom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
