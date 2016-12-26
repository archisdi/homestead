<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['recover'] = 'auth/recover';


//$route['posts'] = 'posts/index';
//$route['posts/create'] = 'posts/create';
//$route['posts/edit/(:any)'] = 'posts/edit/$1';
//$route['posts/update'] = 'posts/update';
//$route['posts/delete/(:any)'] = 'posts/destroy/$1';
//$route['posts/(:any)'] = 'posts/view/$1';

$route['properties'] = 'properties/index';
$route['properties/(:any)'] = 'properties/view/$1';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
