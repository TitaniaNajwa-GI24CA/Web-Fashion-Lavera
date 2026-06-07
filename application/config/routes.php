<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| RESERVED ROUTES
|--------------------------------------------------------------------------
*/

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
$route['login_customer'] = 'auth/login';
$route['register'] = 'auth/register';
$route['proses-login'] = 'auth/proses_login';
$route['proses-register'] = 'auth/proses_register';
$route['update-profile'] = 'auth/update_profile';
$route['forgot-password'] = 'auth/forgot_password';
$route['admin/register-staff'] = 'auth/register_staff';
$route['admin/proses-register-staff'] = 'auth/proses_register_staff';
$route['staff-login'] = 'auth/staff_login';
$route['proses-staff-login'] = 'auth/proses_staff_login';
$route['admin/update-profile'] = 'admin/dashboard/update_profile';
$route['admin/logout'] = 'auth/staff_logout';
$route['logout'] = 'auth/logout';

/*
|--------------------------------------------------------------------------
| CUSTOMER / FRONTEND
|--------------------------------------------------------------------------
*/

$route['home']          = 'home';
$route['collection']    = 'home/collection';
$route['custom-outfit'] = 'home/custom_outfit';
$route['custom_formal'] = 'home/custom_formal';
$route['custom_family'] = 'home/custom_family';
$route['custom_occasion'] = 'home/custom_occasion';
$route['custom_casual'] = 'home/custom_casual';
$route['about']         = 'home/about';
$route['contact']       = 'home/contact';

/*
|--------------------------------------------------------------------------
| ADMIN / FRONTEND
|--------------------------------------------------------------------------
*/

$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/produk-pakaian-jadi'] = 'admin/produk_pakaian_jadi';
$route['admin/simpan-produk-pakaian-jadi'] = 'admin/produk_pakaian_jadi/simpan';
$route['admin/hapus-produk-pakaian-jadi/(:num)'] = 'admin/produk_pakaian_jadi/hapus/$1';
$route['admin/update-produk-pakaian-jadi'] = 'admin/produk_pakaian_jadi/update';
$route['admin/kategori-custom'] = 'admin/kategori_custom';
$route['admin/simpan-kategori-custom'] = 'admin/kategori_custom/simpan';
$route['admin/update-kategori-custom'] = 'admin/kategori_custom/update';
$route['pesanan/form/(:num)'] = 'pesanan/form/$1';
$route['keranjang/tambah/(:num)'] = 'keranjang/tambah/$1';


$route['pesanan/form/(:num)'] = 'pesanan/form/$1';
$route['pesanan/simpan'] = 'pesanan/simpan';
$route['riwayat-pesanan'] = 'pesanan/riwayat';
$route['pesanan/detail/(:num)'] = 'pesanan/detail/$1';
$route['admin/pesanan-pakaian-jadi'] = 'admin/pesanan_pakaian_jadi';
$route['admin/update-status-pesanan-pakaian-jadi'] = 'admin/pesanan_pakaian_jadi/update_status';
$route['admin/detail-pesanan/(:num)'] = 'admin/pesanan_pakaian_jadi/detail/$1';
$route['pesanan/konfirmasi-pembayaran'] = 'pesanan/konfirmasi_pembayaran';
$route['kasir/dashboard'] = 'kasir/dashboard';
$route['kasir/pembayaran-pakaian-jadi'] = 'kasir/pembayaran_pakaian_jadi';
$route['kasir/simpan-pembayaran-cash'] = 'kasir/pembayaran_pakaian_jadi/simpan_cash';
$route['kasir/update-status-pembayaran'] = 'kasir/pembayaran_pakaian_jadi/update_status';
$route['request-custom/form/(:num)'] = 'request_custom/form/$1';
$route['request-custom/simpan'] = 'request_custom/simpan';
$route['admin/request-custom'] = 'admin/request_custom';
$route['admin/update-request-custom'] = 'admin/request_custom/update';
$route['admin/pesanan-custom'] = 'admin/pesanan_custom';
$route['admin/update-status-pesanan-custom'] = 'admin/pesanan_custom/update_status';
$route['admin/detail-pesanan-custom/(:num)'] = 'admin/pesanan_custom/detail/$1';
$route['pesanan/bayar-uang-muka/(:num)'] = 'pesanan/bayar_uang_muka/$1';
$route['pesanan/simpan-uang-muka'] = 'pesanan/simpan_uang_muka';
$route['pesanan/simpan-pembayaran-custom'] = 'pesanan/simpan_pembayaran_custom';
$route['kasir/pembayaran-dp-custom'] = 'kasir/pembayaran_dp_custom';
$route['kasir/update-status-dp-custom'] = 'kasir/pembayaran_dp_custom/update_status';
$route['kasir/pelunasan-custom'] = 'kasir/pelunasan_custom';
$route['kasir/update-status-pelunasan-custom'] = 'kasir/pelunasan_custom/update_status';
$route['kasir/cetak-kwitansi-custom/(:num)'] = 'kasir/pelunasan_custom/cetak_kwitansi/$1';
$route['kasir/cetak-kwitansi-pakaian-jadi/(:num)'] = 'kasir/pembayaran_pakaian_jadi/cetak_kwitansi/$1';