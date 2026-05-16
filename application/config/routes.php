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

$route['login']          = 'auth';
$route['login/proses']  = 'auth/login';
$route['logout']        = 'auth/logout';

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