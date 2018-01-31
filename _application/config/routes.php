<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/index';
$route['([a-z]+)/(:num)'] = '$1/index/$2';
$route['([a-z]+)/(:num)/([a-z]+)'] = '$1/$3/$2';
$route['([a-z]+)/(:num)/([a-z]+)/(:num)'] = '$1/$3/$2/$4';
$route['([a-z]+)/(:num)/(:num)'] = '$1/index/$2/$3';
$route['([a-z]+)/(:num)/(:num)'] = '$1/index/$2/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
