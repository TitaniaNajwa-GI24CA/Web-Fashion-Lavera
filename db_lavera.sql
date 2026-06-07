-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 03:47 PM
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

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `id_user`, `foto_profil`) VALUES
(1, 8, 'admin_8_1779623851.jpeg'),
(2, 12, NULL),
(3, 1, 'admin_1_1780364512.jpeg');

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

--
-- Dumping data for table `tbl_custom`
--

INSERT INTO `tbl_custom` (`id_custom`, `kategori_custom`, `deskripsi_referensi`, `gambar_referensi`, `gambar_bahan`, `status_custom`, `created_at`) VALUES
(1, 'Custom Family Uniform', 'Wujudkan pakaian keluarga yang serasi, sopan, nyaman, dan elegan untuk berbagai momen spesial.', 'gambar_referensi_1780390896.png', 'gambar_bahan_1780390896.png', 'aktif', '2026-06-02 16:01:36'),
(2, 'Custom Formal Wear', 'Desain pakaian formal sesuai kebutuhan kantor, perusahaan, maupun acara profesional dengan sentuhan modern.', 'gambar_referensi_1780391141.png', 'gambar_bahan_1780395297.png', 'aktif', '2026-06-02 16:05:41'),
(3, 'Custom Occasion Wear', 'Wujudkan outfit spesial dengan desain elegan, detail eksklusif, dan sentuhan personal untuk setiap momen berharga.', 'gambar_referensi_1780391225.png', 'gambar_bahan_1780391225.png', 'aktif', '2026-06-02 16:07:05'),
(4, 'Custom Casual Wear', 'Buat outfit casual custom yang nyaman, stylish, dan cocok untuk komunitas, kampus, brand, maupun kebutuhan seragam santai.', 'gambar_referensi_1780391339.png', 'gambar_bahan_1780391339.png', 'aktif', '2026-06-02 16:08:59');

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

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `id_user`, `alamat`, `foto_profil`) VALUES
(1, 1, 'Pondok Sukatani Permai Blok A1 No 19', 'profile_1779351436.jpg'),
(2, 2, 'Sumur Pacing', 'profile_1779350113.jpeg'),
(3, 3, 'Perumahan Royal Rajeg', 'profile_1779621960.jpg'),
(4, 4, 'Kampung Kontrakan Curug', NULL),
(5, 5, 'Pondok Sukatani Permai\r\n', NULL),
(6, 6, 'Los Angeles', NULL),
(7, 7, 'JL ARIA SANTIKA GG SAMAUN RT 03 RW 03 SUMUR PACING KARAWACI KOTA TANGERANG BANTEN', NULL),
(8, 9, 'Seoul, Korea', 'profile_1779440562.jpg'),
(9, 10, 'Bumi Serpong Damai', NULL);

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

--
-- Dumping data for table `tbl_detail_pesanan`
--

INSERT INTO `tbl_detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_pakaian_jadi`, `id_request`, `jumlah`, `harga`, `subtotal`) VALUES
(3, 3, 15, NULL, 1, '101250.00', '101250.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gambar_request`
--

CREATE TABLE `tbl_gambar_request` (
  `id_gambar_request` int(11) NOT NULL,
  `id_request` int(11) NOT NULL,
  `gambar_desain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gambar_request`
--

INSERT INTO `tbl_gambar_request` (`id_gambar_request`, `id_request`, `gambar_desain`) VALUES
(4, 4, '513526a217dd11d09c73fab07e3b4159.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasir`
--

CREATE TABLE `tbl_kasir` (
  `id_kasir` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kasir`
--

INSERT INTO `tbl_kasir` (`id_kasir`, `id_user`, `foto_profil`) VALUES
(1, 11, NULL);

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
  `id_pembayaran` int(11) DEFAULT NULL,
  `id_request` int(11) DEFAULT NULL,
  `target_role` enum('customer','admin','kasir') NOT NULL,
  `jenis_notifikasi` enum('konfirmasi_request','pembayaran_berhasil','bukti_pembayaran','pesanan_dikirim','pesanan_selesai') NOT NULL,
  `judul_notifikasi` varchar(100) NOT NULL,
  `pesan_notifikasi` text NOT NULL,
  `status_baca` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notifikasi`
--

INSERT INTO `tbl_notifikasi` (`id_notifikasi`, `id_customer`, `id_pesanan`, `id_pembayaran`, `id_request`, `target_role`, `jenis_notifikasi`, `judul_notifikasi`, `pesan_notifikasi`, `status_baca`, `created_at`) VALUES
(3, 1, 3, 1, NULL, 'customer', 'bukti_pembayaran', 'Konfirmasi Pembayaran Baru', 'Naura Nur Azizah telah mengupload bukti pembayaran untuk pesanan PSN-20260605105929.', 'belum_dibaca', '2026-06-06 12:52:20'),
(6, 2, NULL, NULL, 4, 'admin', 'konfirmasi_request', 'Request Custom Baru', 'Mahesa Ibrahim mengirim request custom untuk kategori Custom Casual Wear.', 'belum_dibaca', '2026-06-07 19:53:20'),
(7, 2, NULL, NULL, 4, 'customer', 'konfirmasi_request', 'Konfirmasi Request Custom', 'Request custom untuk kategori Custom Casual Wear telah dikonfirmasi admin dengan status Disetujui. Silakan cek detail request custom kamu.', 'belum_dibaca', '2026-06-07 19:56:06');

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

--
-- Dumping data for table `tbl_pakaian_jadi`
--

INSERT INTO `tbl_pakaian_jadi` (`id_pakaian_jadi`, `nama_pakaian`, `detail_model`, `detail_bahan`, `ukuran`, `harga`, `stok`, `diskon_produk`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `status_produk`, `created_at`) VALUES
(1, 'Luna Dress', 'Midi dress dengan potongan feminine, belt waist, dan detail clean modern.', 'Premium soft cotton blend dengan tekstur halus, nyaman, dan jatuh elegan.', 'S', '360000.00', 10, 0, 'produk_1_1780367361.png', 'produk_2_1780367361.png', 'produk_3_1780367361.png', 'produk_4_1780367362.png', 'Aktif', '2026-06-02 09:29:22'),
(2, 'Luna Dress', 'Midi dress dengan potongan feminine, belt waist, dan detail clean modern.', 'Premium soft cotton blend dengan tekstur halus, nyaman, dan jatuh elegan.', 'M', '360000.00', 15, 0, 'produk_1_1780367934.png', 'produk_2_1780367934.png', 'produk_3_1780367934.png', 'produk_4_1780367934.png', 'Aktif', '2026-06-02 09:38:54'),
(3, 'Luna Dress', 'Midi dress dengan potongan feminine, belt waist, dan detail clean modern.', 'Premium soft cotton blend dengan tekstur halus, nyaman, dan jatuh elegan.', 'L', '360000.00', 20, 0, 'produk_1_1780368013.png', 'produk_2_1780368013.png', 'produk_3_1780368013.png', 'produk_4_1780368013.png', 'Aktif', '2026-06-02 09:40:13'),
(4, 'Luna Dress', 'Midi dress dengan potongan feminine, belt waist, dan detail clean modern.', 'Premium soft cotton blend dengan tekstur halus, nyaman, dan jatuh elegan.', 'XL', '360000.00', 5, 0, 'produk_1_1780368088.png', 'produk_2_1780368088.png', 'produk_3_1780368088.png', 'produk_4_1780368088.png', 'Aktif', '2026-06-02 09:41:28'),
(5, 'Elara Top', 'Blouse soft pink dengan cutting loose elegant dan detail button front.', 'Silky blouse fabric yang ringan, lembut, dan nyaman dipakai seharian.', 'S', '275000.00', 23, 0, 'produk_1_1780374341.png', 'produk_2_1780374341.png', 'produk_3_1780374341.png', 'produk_4_1780374341.png', 'Aktif', '2026-06-02 11:25:41'),
(7, 'Elara Top', 'Blouse soft pink dengan cutting loose elegant dan detail button front.', 'Silky blouse fabric yang ringan, lembut, dan nyaman dipakai seharian.', 'M', '275000.00', 17, 0, 'produk_1_1780414028.png', 'produk_2_1780414028.png', 'produk_3_1780414028.png', 'produk_4_1780414028.png', 'Aktif', '2026-06-02 22:27:08'),
(8, 'Elara Top', 'Blouse soft pink dengan cutting loose elegant dan detail button front.', 'Silky blouse fabric yang ringan, lembut, dan nyaman dipakai seharian.', 'L', '275000.00', 32, 0, 'produk_1_1780415678.png', 'produk_2_1780415678.png', 'produk_3_1780415678.png', 'produk_4_1780415678.png', 'Aktif', '2026-06-02 22:54:38'),
(9, 'Elara Top', 'Blouse soft pink dengan cutting loose elegant dan detail button front.', 'Silky blouse fabric yang ringan, lembut, dan nyaman dipakai seharian.', 'XL', '275000.00', 2, 0, 'produk_1_1780415760.png', 'produk_2_1780415760.png', 'produk_3_1780415760.png', 'produk_4_1780415760.png', 'Aktif', '2026-06-02 22:56:00'),
(10, 'Naia Set', 'Set blazer dan celana warna lavender dengan potongan modern office look.', 'Premium suit fabric, adem, rapi, dan tidak mudah kusut.', 'S', '685000.00', 12, 0, 'produk_1_1780415892.png', 'produk_2_1780415892.png', 'produk_3_1780415892.png', 'produk_4_1780415892.png', 'Aktif', '2026-06-02 22:58:12'),
(11, 'Naia Set', 'Set blazer dan celana warna lavender dengan potongan modern office look.', 'Premium suit fabric, adem, rapi, dan tidak mudah kusut.', 'M', '685000.00', 7, 0, 'produk_1_1780416015.png', 'produk_2_1780416015.png', 'produk_3_1780416015.png', 'produk_4_1780416015.png', 'Aktif', '2026-06-02 23:00:15'),
(12, 'Aurelia Outer', 'Outer mint dengan cutting loose, front drape, dan lengan clean casual.', 'Light outer fabric yang flowy, ringan, dan nyaman untuk layering.', 'S', '550000.00', 4, 0, 'produk_1_1780417150.png', 'produk_2_1780417150.png', 'produk_3_1780417150.png', 'produk_4_1780417150.png', 'Aktif', '2026-06-02 23:19:11'),
(13, 'Celine Oneset', 'Sleeveless oneset dengan belt waist dan look formal feminine.', 'Premium semi-wool blend, lembut, tebal sedang, dan jatuh rapi.', 'S', '890000.00', 8, 0, 'produk_1_1780417246.png', 'produk_2_1780417246.png', 'produk_3_1780417246.png', 'produk_4_1780417246.png', 'Aktif', '2026-06-02 23:20:46'),
(14, 'Aria Dress', 'Dress terracotta dengan potongan wrap dan detail belt elegan.', 'Soft flowy fabric dengan tekstur ringan dan nyaman.', 'S', '445000.00', 11, 80, 'produk_1_1780417350.png', 'produk_2_1780417350.png', 'produk_3_1780417350.png', 'produk_4_1780417350.png', 'Aktif', '2026-06-02 23:22:30'),
(15, 'Lea T-Shirt', 'T-shirt biru muda dengan cutting modern dan aksen side knot.', 'Cotton combed premium yang adem, stretch ringan, dan halus.', 'S', '135000.00', 7, 25, 'produk_1_1780501195.png', 'produk_2_1780501195.png', 'produk_3_1780501195.png', 'produk_4_1780501195.png', 'Aktif', '2026-06-03 22:39:55'),
(16, 'Mira Blouse', 'Blouse navy dengan detail button dan potongan formal casual.', 'Satin silk look, ringan, glossy soft, dan nyaman.', 'S', '215000.00', 26, 0, 'produk_1_1780501341.png', 'produk_2_1780501341.png', 'produk_3_1780501341.png', 'produk_4_1780501341.png', 'Aktif', '2026-06-03 22:42:21'),
(17, 'Sienna Dress', 'Soft satin premium dengan efek jatuh mewah.', 'Dress kuning pastel dengan neckline drape dan silhouette elegant.', 'S', '635000.00', 6, 0, 'produk_1_1780501483.png', 'produk_2_1780501483.png', 'produk_3_1780501483.png', 'produk_4_1780501483.png', 'Aktif', '2026-06-03 22:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `id_request` int(11) DEFAULT NULL,
  `kode_pembayaran` varchar(30) NOT NULL,
  `jenis_pembayaran` enum('uang_muka_custom','pembayaran_pakaian_jadi','pelunasan_custom') NOT NULL,
  `metode_pembayaran` enum('cash','transfer') NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('belum_bayar','menunggu_verifikasi','berhasil','ditolak') DEFAULT 'menunggu_verifikasi',
  `tanggal_pembayaran` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_pesanan`, `id_request`, `kode_pembayaran`, `jenis_pembayaran`, `metode_pembayaran`, `jumlah_bayar`, `bukti_pembayaran`, `status_pembayaran`, `tanggal_pembayaran`) VALUES
(1, 3, NULL, 'PAY-20260605105929', 'pembayaran_pakaian_jadi', 'transfer', '101250.00', '4db70d509510722a443efabe3d7cc3a3.jpeg', 'berhasil', '2026-06-06 07:52:20'),
(2, 4, 4, 'BYR-DP-20260607145606', 'uang_muka_custom', 'transfer', '350000.00', NULL, 'belum_bayar', '2026-06-07 19:56:06');

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
  `ekspedisi` varchar(50) DEFAULT NULL,
  `metode_pembayaran` enum('transfer','cash') DEFAULT NULL,
  `tanggal_pesanan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_customer`, `id_request`, `kode_pesanan`, `total_bayar`, `tipe_pesanan`, `status_pesanan`, `metode_pengambilan`, `alamat_pengiriman`, `ekspedisi`, `metode_pembayaran`, `tanggal_pesanan`) VALUES
(3, 1, NULL, 'PSN-20260605105929', '101250.00', 'pakaian_jadi', 'diproses', 'delivery', 'Pondok Sukatani Permai Blok A1 No 19', 'J&T', 'transfer', '2026-06-05 15:59:29'),
(4, 2, 4, 'PSN-CUS-20260607145606', '700000.00', 'custom', 'pending', 'delivery', NULL, NULL, NULL, '2026-06-07 19:56:06');

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

--
-- Dumping data for table `tbl_request_custom`
--

INSERT INTO `tbl_request_custom` (`id_request`, `id_customer`, `id_custom`, `detail_custom`, `estimasi_harga`, `diskon_custom`, `uang_muka`, `status_request`, `tanggal_request`) VALUES
(4, 2, 4, 'Saya mau baju yang keren dan elegan untuk organisasi BEM', '700000.00', 0, '350000.00', 'Disetujui', '2026-06-07 19:53:20');

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
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `nama_user`, `username`, `email`, `password`, `role`, `no_telepon`, `status_akun`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Naura Nur Azizah', 'Naura', 'enay_cantik0714@gmail.com', '$2y$10$znKxLN6lGFKFhB5F2XDEkuwC/ydW8Dmq75B0PG9bboP2sNRMrRfTO', 'customer', '081288072224', 'aktif', '2026-06-07 13:02:57', '2026-05-20 00:05:57', '2026-06-07 18:02:57'),
(2, 'Mahesa Ibrahim', 'Ecaaa', 'mhsaibrahim16@gmail.com', '$2y$10$IGJ1d7v6hZIjHcmiwIgj/uTRJ/8am66NDj19JMFfKkdqqM5omWvdu', 'customer', '08561234568', 'aktif', '2026-06-07 15:30:43', '2026-05-20 00:58:37', '2026-06-07 20:30:43'),
(3, 'Kirana Malika Syafir', 'Kirana', 'kiranacantik@gmail.com', '$2y$10$jN/GDEgTMX06XsK5acftuOVTj8s7ruXI6ybMqPU.a9wrBRBCJ4Sp6', 'customer', '081212806842', 'aktif', '2026-05-24 13:25:44', '2026-05-21 10:56:45', '2026-05-24 18:25:44'),
(4, 'Yuniar Ayu Indriyanti', 'Ayu', 'yuniarayuind0106@gmail.com', '$2y$10$w2YldNp.DG/Ff8cSaSzR9e3evxnUDMQ2JBg3PmzXNEkkDh2WqjDoq', 'customer', '081288072224', 'aktif', '2026-05-21 17:23:17', '2026-05-21 11:05:22', '2026-05-21 22:23:17'),
(5, 'Shafira Arintia Zen', 'Shafira', 'Shafiraarinzen23@gmail.com', '$2y$10$9LSPb5RudCe8WKRs2cgDMeAUlDvGjgIvWE52/qrWRTET291WDWaPy', 'customer', '08123456789', 'aktif', NULL, '2026-05-21 11:13:30', '2026-05-21 11:13:30'),
(6, 'Ariana Grande', 'Ariana', 'arianagrande12@gmail.com', '$2y$10$54IBXU4uHJ5NAcBIZ1SevO.2mgSf.K/BXoHR/E6TPxKlzeOGRlM/q', 'customer', '081524351682', 'aktif', '2026-05-22 10:43:05', '2026-05-21 12:00:24', '2026-05-22 15:43:05'),
(7, 'Mikhayla Arsya', 'cipittt', 'mikhayla@gmail.com', '$2y$10$UuN2f36aZ3E1G8zIU7JOQOWmpm70p23/dF1IoxVAdTdIEa/9/RSbG', 'customer', '085693410670', 'aktif', '2026-05-21 09:20:18', '2026-05-21 14:19:57', '2026-05-21 14:20:18'),
(8, 'Titania Najwa', 'Inong', 'titanianajawaa023@gmail.com', '$2y$10$LKv7yEGR7NEmeiuWHkDugOYjp4xaOGyzbs9mFemWkfmqAigSipwwi', 'admin', '081315352350', 'aktif', '2026-06-07 11:08:29', '2026-05-21 23:54:56', '2026-06-07 16:08:29'),
(9, 'Lee-ana', 'je-hoon gf', 'analee@gmail.com', '$2y$10$y6hvHwAJWijJvtQxjlEfKegi6w.Z9rE7AtSGCqj0PmnOdeHtyPeCa', 'customer', '081219097611', 'aktif', '2026-05-22 10:51:33', '2026-05-22 15:49:57', '2026-05-22 15:51:33'),
(10, 'Syifa Hadju', 'Syifa Hadju', 'syifahadju012@gmail.com', '$2y$10$oSvW4w.zUtuDLQLm6usDKuj2HddI.e1e31djlQxHc7yoWf.WgG0e.', 'customer', '081615342678', 'aktif', '2026-05-24 14:33:32', '2026-05-24 19:31:40', '2026-05-24 19:33:32'),
(11, 'Riska Yulia Rahma', 'Riska', '1224160027@global.ac.id', '$2y$10$jI40JtKxyi/f/cE./fJ2euDxfRWzmAOwJp7UDJhIW2O82/v8KvwDS', 'kasir', '081223456789', 'aktif', NULL, '2026-05-24 20:05:18', '2026-05-24 20:05:18'),
(12, 'Fitriana Hendayati', 'Ipit', '1224160037@global.ac.id', '$2y$10$yN7b/kCSO7Vk79O53fu7w.P/bQFojlPBskbGXwvkzi8VkyJPPVyfK', 'admin', '081223456789', 'aktif', NULL, '2026-05-24 20:08:36', '2026-05-24 20:23:33');

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
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_pembayaran` (`id_pembayaran`),
  ADD KEY `id_request` (`id_request`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_custom`
--
ALTER TABLE `tbl_custom`
  MODIFY `id_custom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_gambar_request`
--
ALTER TABLE `tbl_gambar_request`
  MODIFY `id_gambar_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_pakaian_jadi`
--
ALTER TABLE `tbl_pakaian_jadi`
  MODIFY `id_pakaian_jadi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_request_custom`
--
ALTER TABLE `tbl_request_custom`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `tbl_notifikasi_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_notifikasi_ibfk_3` FOREIGN KEY (`id_pembayaran`) REFERENCES `tbl_pembayaran` (`id_pembayaran`),
  ADD CONSTRAINT `tbl_notifikasi_ibfk_4` FOREIGN KEY (`id_request`) REFERENCES `tbl_request_custom` (`id_request`);

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
