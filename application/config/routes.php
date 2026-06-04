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
