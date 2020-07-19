<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['index/index_list']='index/index_list/1';
$route['default_controller'] = 'index';
$route['404_override'] = '';
$rount['index/info/scholarship/(:num)']="$1";
$route['translate_uri_dashes'] = FALSE;
$rount['index/board/notice/(:num)/(:num)']="$1/$2";