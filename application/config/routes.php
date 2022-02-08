<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['stock/in'] = 'stock/stock_in_data';
$route['stock/in/tambah'] = 'stock/stock_in_add';

$route['stock/out'] = 'stock/stock_out_data';
$route['stock/out/tambah'] = 'stock/stock_out_add';